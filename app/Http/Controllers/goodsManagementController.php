<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Good;
use App\Models\UserGood;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use League\Csv\Reader;

class goodsManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Create a new controller instance.
     *
     * @return void
    */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $item = $request->input('value');
        if($item) {
            $members = User::where(function($query) use ($item) {
                $query->where('name', 'like', '%' . $item . '%')
                    ->orWhere('email', 'like', '%' . $item . '%')
                    ->orWhere('company_name', 'like', '%' . $item . '%');
            })
                ->where('user_role', 3)
                ->paginate(10);
            return view('goods/viewAllGoodsForMembers')->with("members", $members);
        }else {
            $members = User::where('user_role', 3)->paginate(10);
            return view('goods/viewAllGoodsForMembers')->with("members", $members);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $manageGoodsId = $request->input('manageId');
        $goodsTitle = $request->input('goodsTitle');
        $goodsInventory = $request->input('goodsInventory');
        $id = $request->input('userId');

        $good = Good::create([
            "manageGoodsId" => $manageGoodsId,
            "goodsTitle" => $goodsTitle,
            "goodsInventory" => $goodsInventory,
        ]);

        $goodId = $good->id;

        UserGood::create([
            "user_id" => $id,
            "good_id" => $goodId,
        ]);

        // echo $manageGoodsId;

        $user = User::find($id);
        $allUserInfor = User::where('user_role', 3)->get();
        $goods = $user->goods()->paginate(10);
        // return view('goods/manageGoods');
        return view('goods/manageGoods')->with("goods", $goods)->with("userId", $id)->with("allUserInfor", $allUserInfor);
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $value = $request->input('value');
        $query = User::find($id)->goods();
        if ($value && $value != "selectedOption") {
            $query = $query ->where('manageGoodsId', 'like', '%' . $value . '%')
                            ->orWhere('goodsTitle', 'like', '%' . $value . '%')
                            ->where('user_id', $id);
        }

        $goods = $query->paginate(10);
        $allUserInfor = User::where('user_role', 3)->get();
        return view("goods/manageGoods")->with("goods", $goods)->with("userId", $id)->with("allUserInfor", $allUserInfor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $user_id = $request->input('userIdValue');
        $good_id = $request->input('goodsIdValue');
        try {
            $user_goods = UserGood::where('user_id', $user_id)
                                    ->where('good_id', $good_id)
                                    ->first();
            $user_goods->delete();
            return response()->json(['message' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'error']);
        }
    }

    public function download($id)
    {
        $cnt = 0;
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => `attachment; filename=goods_${cnt}.csv`,
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];
        $list = User::find($id)->goods()->get()->toArray();
        $callback = function() use ($list)
        {
            $title = ["管理ID", "本のタイトル", "在庫数", "現在の注文数","発送可能在庫数"];
            $FH = fopen('php://output', 'w');
            fputcsv($FH, $title);
            foreach ($list as $row) {
                $tmp = [$row["manageGoodsId"], $row["goodsTitle"], $row["goodsInventory"], "AmountOfGoods", "RemainOders"];
                fputcsv($FH, $tmp);
            }
            fclose($FH);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function upload($id, Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);
        
        // Get the uploaded file
        $file = $request->file('file');
        
        // Read the CSV file
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0);
        
        // Get the CSV data as an array
        $data = $csv->getRecords();

        // Process the CSV data as per your requirements
        foreach ($data as $record) {
            // Access the fields of each CSV record
            $manageGoodsId = $record['管理ID'];
            $goodsTitle = $record['本のタイトル'];
            $goodsInventory = $record['在庫数'];
            $amountOfOders = $record['現在の注文数'];
            $remainOders = $record['発送可能在庫数'];

            $goods = User::find($id)->goods()->where('manageGoodsId', $manageGoodsId)->first();
            if($goods) {
                $goods->goodsTitle = $goodsTitle;
                $goods->goodsInventory = $goodsInventory;
                $goods->save();
            } else {
                $good = Good::create([
                    "manageGoodsId" => $manageGoodsId,
                    "goodsTitle" => $goodsTitle,
                    "goodsInventory" => $goodsInventory,
                ]);

                $goodId = $good->id;

                UserGood::create([
                    "user_id" => $id,
                    "good_id" => $goodId,
                ]);
            }
        }
        return redirect()->back()->with('success', 'CSV file uploaded and processed successfully.');
    }
}

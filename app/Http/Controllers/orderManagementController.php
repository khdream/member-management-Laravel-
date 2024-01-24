<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Order;
use App\Models\User;
use App\Models\Good;
use App\Models\Destination;
use App\Models\ManageOrder;
use Auth;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use League\Csv\Reader;

class orderManagementController extends Controller
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
        $value = $request->input('value');
        $isUser = Auth::user()->user_role;

        if($isUser == 1 || $isUser == 2) {
            $orders = User::with('orders')->paginate(5);
            return view('orders/viewOders')->with('datas', $orders);
        }else {
            if($value != null) {
                $orders = Order::where('user_id', Auth::user()->id)
                                    ->where(function($query) use ($value) {
                                        $query->where('order_name', 'like', '%' . $value . '%')
                                            ->orWhere('id', 'like', '%' . $value . '%');
                                    })
                                    ->paginate(5);
                return view('orders/viewUserOrderDetail')->with('datas', $orders);
            } else {
                $orders = Order::where('user_id', Auth::user()->id)->paginate(5);
                return view('orders/viewUserOrderDetail')->with('datas', $orders);
            }
        }
    }

    public function searchResult(Request $request) {
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        // $startDateTime = Carbon::parse($startDate)->startOfDay();
        // $endDateTime = Carbon::parse($endDate)->endOfDay();
        // $startDateMilliseconds = strtotime($startDate) * 1000;
        // $endDateMilliseconds = strtotime($endDate) * 1000;
        // $startTimeStamp = Carbon::parse($startDate);
        // $endTimeStamp = Carbon::parse($endDate);

        $orders = Order::where('user_id', Auth::user()->id)
                                    ->where('created_at', '>=', $startTimeStamp)
                                    ->where('created_at', '<=', $endTimeStamp)
                                    ->paginate(50);
        return view('orders/viewUserOrderDetail')->with('datas', $orders);
    }

    public function store(Request $request)
    {
        try {
            $datas = $request->input('datas');
            $delivery_date = $request->input('delivery_date');
            $des_id = $request->input('des_id');
            $flag = true;
            // $order_name = 'AAB-' . Auth::user()->id;

            $user = User::find(Auth::user()->id);

            $destinationIds = [
                $des_id['d0Id'],
                $des_id['d1Id'], 
                $des_id['d2Id'],
                $des_id['d3Id'], 
            ];

            foreach ($destinationIds as $destinationId) {
                if($user->destinations()->whereHas('user_destinations', function($q) use ($destinationId) {
                    $q->where('destination_id', $destinationId); 
                })->exists()) {
                    continue;
                } else {
                    $flag = false;
                    break;
                }
            }

            if($flag) {
                $newOrder = Order::create([
                    'order_name' => 'AA-3',
                    'user_id' => Auth::user()->id,
                    'status' => '発送前',
                    'delivery_date' => $delivery_date,
                    'estimate_delivery_date' => $delivery_date,
                ]);
                $newOrder->order_name = 'AAD-' . $newOrder->id;
                $newOrder->save();
                foreach($datas as $data) {
                    for($i = 0; $i < 4; $i++) {
                            $manageOrders = ManageOrder::create([
                                'order_id' => $newOrder->id,
                               'good_id' => $data['goodId'],
                               'destination_id' => $data['d' . $i . 'Id'],
                                'quantity' => $data['d' . $i],
                            ]);
                    }
                }
                echo "success";
            } else {
                echo "falid";
            }

        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $datas = $request->input('datas');
            $orderStatus = $request->input('orderStatus');
            foreach($datas as $data) {
                for($i = 0; $i < 4; $i++) {
                    $manageOrders = ManageOrder::where('order_id', $id)
                                            ->where('good_id', $data['goodId'])
                                            ->where('destination_id', $data['d'.$i.'Id'])
                                            ->first();
                    if($manageOrders) {
                        $manageOrders->quantity = $data['d' . $i];
                        $isUpdated = $manageOrders->save();
                    }
                }
            }
            $orders = Order::find($id);
            $orders->status = $orderStatus;
            $orders->save();
            if ($orderStatus == "完了") {
                foreach($datas as $data) {
                    for($i = 0; $i < 4; $i++) {
                        $good = Good::find($data['goodId']);
                        $good->goodsInventory -= $data['d'. $i];
                        $good->save();
                    }
                }
            }
            echo "success";
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
        // echo $isUpdated;
    }

    public function createNewOrder(Request $request) {
        $goods = User::find(Auth::user()->id)->goods()->paginate(10);
        return view('orders/orderRequest')->with('datas', $goods);
    }

    public function showDetailOrder($user_id, $order_id) {
        $isSame = null;
        $datas = [];
        $tmp = [];
        $data = [];
        $locations = [];
        $destination_ids = [];
        $date = [];
        $count = 0;
        $all_quantity = 0;

        $order_date = Order::find($order_id);
        $created_at = $order_date->created_at->format('Y/m/d');
        $updated_at = $order_date->updated_at->format('Y/m/d');
        $delivery_date = $order_date->delivery_date;
        $estimate_delivery_date = $order_date->estimate_delivery_date;
        $status = $order_date->status;
        $user_name = User::find($user_id)->name;
        $company_name = User::find($user_id)->company_name;

        $date = [
            $created_at, 
            $updated_at, 
            $delivery_date, 
            $estimate_delivery_date, 
            $status, 
            $user_name,
            $order_id,
            $company_name
        ];

        $manage_orders = ManageOrder::where('order_id', $order_id)->get();
        foreach ($manage_orders as $manage_order) {
            $count++;
            $good_id = $manage_order->good_id;
            $good = Good::find($good_id);

            $good_manageId = $good->manageGoodsId;
            $good_title = $good->goodsTitle;
            $good_inventory = $good->goodsInventory;
            $destination = Destination::find($manage_order->destination_id);
            $destination_location = $destination->destinationLocation;
            $quantity = $manage_order->quantity;
            $all_quantity += $quantity;
            $remain_quantity = $good_inventory - $all_quantity;
            array_push($locations, $destination_location);
            array_push($destination_ids, $manage_order->destination_id);
            array_push($tmp, [
                'location'=> $destination_location, 
                'quantity' => $quantity,
                'destination_id' => $manage_order->destination_id,
            ]);
            $data = [
                'order_id' => $order_id,
                'good_id' => $good_id,
                'good_manageId' => $good_manageId,
                'good_title' => $good_title,
                'good_inventory' => $good_inventory,
                'all_quantity'=> $all_quantity, 
                'remain_quantity' => $remain_quantity,
                'destination_location' => $tmp,
            ];
            if($isSame != $good_id) {
                $isSame = $good_id;
            }
            if($count == 4) {
                array_push($datas, $data);
                $data = [];
                $tmp = [];
                $count = 0;
                $all_quantity = 0;
            }
        }
        $locations = array_unique($locations);
        $destination_ids = array_unique($destination_ids);
        return view('orders/viewDetailOrder')->with('datas', $datas)
                                                ->with('locations', $locations)
                                                ->with('date', $date);
    }

    public function ordersDownload($order_id) {
        $cnt = 0;
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => `attachment; filename=goods_${cnt}.csv`,
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];
        //////////////////////////////////////////////////////////////
        
        $isSame = null;
        $datas = [];
        $tmp = [];
        $data = [];
        $locations = [];
        $date = [];
        $count = 0;
        $all_quantity = 0;

        $order_date = Order::find($order_id);
        $created_at = $order_date->created_at->format('Y/m/d');
        $updated_at = $order_date->updated_at->format('Y/m/d');
        $delivery_date = $order_date->delivery_date;
        $estimate_delivery_date = $order_date->estimate_delivery_date;
        $status = $order_date->status;
        $user_id = $order_date->user_id;
        $user_name = User::find($user_id)->name;
        $date = [
            $created_at, 
            $updated_at, 
            $delivery_date, 
            $estimate_delivery_date, 
            $status, 
            $user_name,
            $order_id
        ];

        $manage_orders = ManageOrder::where('order_id', $order_id)->get();
        foreach ($manage_orders as $manage_order) {
            $count++;
            $good_id = $manage_order->good_id;
            $good = Good::find($good_id);

            $good_manageId = $good->manageGoodsId;
            $good_title = $good->goodsTitle;
            $good_inventory = $good->goodsInventory;
            $destination = Destination::find($manage_order->destination_id);
            $destination_location = $destination->destinationLocation;
            $quantity = $manage_order->quantity;
            $all_quantity += $quantity;
            $remain_quantity = $good_inventory - $all_quantity;
            array_push($locations, $destination_location);
            array_push($tmp, [
                'location'=> $destination_location, 
                'quantity' => $quantity,
                'destination_id' => $manage_order->destination_id,
            ]);
            $data = [
                'order_id' => $order_id,
                'good_id' => $good_id,
                'good_manageId' => $good_manageId,
                'good_title' => $good_title,
                'good_inventory' => $good_inventory,
                'all_quantity'=> $all_quantity, 
                'remain_quantity' => $remain_quantity,
                'destination_location' => $tmp,
            ];
            if($isSame != $good_id) {
                $isSame = $good_id;
            }
            if($count == 4) {
                array_push($datas, $data);
                $data = [];
                $tmp = [];
                $count = 0;
                $all_quantity = 0;
            }
        }
        $locations = array_unique($locations);

        // dd($locations);
        
        //////////////////////////////////////////////////////////////


        // $list = User::find($id)->goods()->get()->toArray();
        $dateDatas1 = ["受注日時", $date[0]];
        $dateDatas2 = ['最終更新日時', $date[1]];
        $dateDatas3 = ['発送完了日', $date[2]];
        $dateDatas4 = ['発送予定日',$date[3]];
        $dateDatas5 = ['ステータス', $date[4]];
        $FH = fopen('php://output', 'w');
        fputcsv($FH, $dateDatas1);
        fputcsv($FH, $dateDatas2);
        fputcsv($FH, $dateDatas3);
        fputcsv($FH, $dateDatas4);
        fputcsv($FH, $dateDatas5);
        fputcsv($FH, []);
        fputcsv($FH, []);
        fclose($FH);
        $callback = function() use ($datas)
        {
            if(Auth::user()->user_role == 3) {
                $title1 = ["管理ID", "本のタイトル", "", "配送先", "", "", "出荷計","在庫"] ;
                $title2 = ["", "", "QQQ1", "QQQ2", "QQQ3", "QQQ4", "",""] ;
            } else {
                $title1 = ["管理ID", "本のタイトル", "", "配送先", "", "", "出荷計","在庫", "出荷後在庫"] ;
                $title2 = ["", "", "QQQ1", "QQQ2", "QQQ3", "QQQ4", "","", ""] ;
            }
            $FH = fopen('php://output', 'w');
            fputcsv($FH, $title1);
            fputcsv($FH, $title2);
            if(Auth::user()->user_role == 3) {
                foreach ($datas as $row) {
                    $tmp = [
                        $row["good_manageId"], 
                        $row["good_title"], 
                        $row["destination_location"][0]['quantity'], 
                        $row["destination_location"][1]['quantity'], 
                        $row["destination_location"][2]['quantity'], 
                        $row["destination_location"][3]['quantity'], 
                        $row["all_quantity"],
                        $row["good_inventory"],
                    ];
                    fputcsv($FH, $tmp);
                }
            } else {
                foreach ($datas as $row) {
                    $tmp = [
                        $row["good_manageId"], 
                        $row["good_title"], 
                        $row["destination_location"][0]['quantity'], 
                        $row["destination_location"][1]['quantity'], 
                        $row["destination_location"][2]['quantity'], 
                        $row["destination_location"][3]['quantity'], 
                        $row["all_quantity"],
                        $row["good_inventory"],
                        $row["remain_quantity"],
                    ];
                    fputcsv($FH, $tmp);
                }
            }
            fclose($FH);
        };

        return response()->stream($callback, 200, $headers);
    }
    public function ordersRequestDownload() {
        $cnt = 0;
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => `attachment; filename=goods_${cnt}.csv`,
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $goods = User::find(Auth::user()->id)->goods;
        $dateDatas = ["発送日", '2024-02-22'];
        $FH = fopen('php://output', 'w');
        fputcsv($FH, $dateDatas);
        fputcsv($FH, []);
        fclose($FH);
        $callback = function() use ($goods)
        {
            // $title1 = ["管理ID", "本のタイトル", "配送先ID /ラベル", "出荷計","在庫"] ;
            // $title1 = ["管理ID", "本のタイトル", "", "配送先ID /ラベル", "", "", "出荷計","在庫"] ;
            // $title2 = ["", "", "1", "2", "3", "4", "",""] ;
            // $title3 = ["", "", "Q1", "Q2", "Q3", "Q4", "",""];
            
            $title1 = ["", "", "", "配送先ID /ラベル", "", "", "",""] ;
            $title2 = ["", "", "1", "2", "3", "4", "",""] ;
            $title3 = ["管理ID", "本のタイトル", "Q1", "Q2", "Q3", "Q4", "出荷計","在庫"] ;

            $FH = fopen('php://output', 'w');
            fputcsv($FH, $title1);
            fputcsv($FH, $title2);
            fputcsv($FH, $title3);
            foreach ($goods as $row) {
                $tmp = [
                    $row["manageGoodsId"], 
                    $row["goodsTitle"], 
                    "", 
                    "", 
                    "", 
                    "",
                    "",
                    $row["goodsInventory"],
                ];
                fputcsv($FH, $tmp);
            }
            fclose($FH);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function orderRequestUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);
        $file = $request->file('file');
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(4);
        $datas = $csv->getRecords();

        $key_0 = '';
        $key_1 = '';
        $key_2 = '';
        $key_3 = '';
        $des_id_0 = '';
        $des_id_1 = '';
        $des_id_2 = '';
        $des_id_3 = '';
        $delivery_date = '';
        $flag = true;
        $isOver = false;

        foreach ($datas as $key => $data) {
            if ($key == 0) {
                $delivery_date = $data['本のタイトル'];
            }else if($key == 3) {
                $cnt = -2;
                foreach ($data as $k => $d) {
                    $key_value = "key_$cnt"; 
                    $$key_value = $k;
                    $des_id_value = "des_id_$cnt"; 
                    $$des_id_value = $d;
                    $cnt++;
                }
            }else if ($key > 3) {
                $goodsInventory = $data['在庫'];
                $d_0_quantity = $data[$key_0];
                $d_1_quantity = $data[$key_1];
                $d_2_quantity = $data[$key_2];
                $d_3_quantity = $data[$key_3];

                $all_quantity = (int)$d_0_quantity + (int)$d_1_quantity + (int)$d_2_quantity +(int)$d_3_quantity;
                echo(var_dump((int) $goodsInventory));
                echo("=>");
                echo(var_dump($all_quantity));
                echo(" , ");

                if((int) $goodsInventory < $all_quantity) {
                    $isOver = true;
                    break;
                }
            }
        }
        $user = User::find(Auth::user()->id);
        $destinationIds = [
            $des_id_0,
            $des_id_1, 
            $des_id_2, 
            $des_id_3, 
        ];
        foreach ($destinationIds as $destinationId) {
            if($user->destinations()->whereHas('user_destinations', function($q) use ($destinationId) {
                $q->where('destination_id', $destinationId); 
            })->exists()) {
                continue;
            } else {
                $flag = false;
                break;
            }
        }

        if($flag && !$isOver) {
            try{
                $newOrder = Order::create([
                    'order_name' => 'AA-3',
                    'user_id' => Auth::user()->id,
                    'status' => '発送前',
                    'delivery_date' => $delivery_date,
                    'estimate_delivery_date' => $delivery_date,
                ]);
                $newOrder->order_name = 'AAD-' . $newOrder->id;
                $newOrder->save();
                
                $getDataCnt = 0;
                foreach ($datas as $key => $data) {
                    $getDataCnt++;
                    if($getDataCnt > 3) {
                        $manageGoodsId = $data['管理ID'];
                        $goodsTitle = $data['本のタイトル'];
                        $goodsInventory = $data['在庫'];
                        $d_0_quantity = $data[$key_0];
                        $d_1_quantity = $data[$key_1];
                        $d_2_quantity = $data[$key_2];
                        $d_3_quantity = $data[$key_3];

                        // $all_quantity = (int)$d_0_quantity + (int)$d_1_quantity + (int)$d_2_quantity +(int)$d_3_quantity;
                        $dQuantities = [$d_0_quantity, $d_1_quantity, $d_2_quantity, $d_3_quantity];
                        // if($goodsInventory < $all_quantity) {
                        //     $isOver = true;
                        //     break;
                        // }
                        $good_id = Good::where('manageGoodsId', $manageGoodsId)->first()->id;
                        for($i = 0; $i < 4; $i++) {
                            $manageOrders = ManageOrder::create([
                                'order_id' => $newOrder->id,
                                'good_id' => $good_id,
                                'destination_id' => $destinationIds[$i],
                                'quantity' => $dQuantities[$i],
                            ]);
                        }
                    }
                }
                echo "success";
            } catch (\Exception $e) {
                throw new \Exception($e);
            }
            // return redirect()->back()->with('success', 'CSV file uploaded and processed successfully.');
        } else {
            echo "falid";
        }
    }
}

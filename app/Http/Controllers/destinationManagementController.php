<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Destination;
use App\Models\UserDestination;

class destinationManagementController extends Controller
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
    
    public function index()
    {
        return view('destinations/shippingDestinationsManagement');
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
        $userId = $request->input('clientId');
        $destinationName = $request->input('destinationName');
        $locationName = $request->input('locationName');
        $streetAddressName = $request->input('streetAddressName');
        $destinationBuildingName = $request->input('destinationBuildingName');

        $postCodeSuffix = $request->input('post_code_suffix');
        $postCodePrefix = $request->input('post_code_prefix');
        $destinationPostCode = $postCodePrefix . '-' . $postCodeSuffix;

        // echo $destinationPostCode;
        // echo $destinationName;
        // echo $locationName;
        // echo $streetAddressName;
        // echo $destinationBuildingName;
        // echo $userId;

        $destination = Destination::create([
            "destinationName" => $destinationName,
            "destinationPostCode" => $destinationPostCode,
            "destinationLocation" => $locationName,
            "destinationStreetAdress" => $streetAddressName,
            "destinationBuildingName" => $destinationBuildingName,
        ]);

        $user = User::find($userId);
        $user->destinations()->attach($destination->id);
        // $destination = $good->id;

        // UserGood::create([
        //     "user_id" => $id,
        //     "good_id" => $goodId,
        // ]);


        echo "success";

        // $user = User::find($id);
        // $allUserInfor = User::where('user_role', 3)->get();
        // $goods = $user->goods()->paginate(10);
        // return view('goods/manageGoods');
        // return view('goods/shippingDestinationsManagement');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}

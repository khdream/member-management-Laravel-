<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class orderManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('orders/oderRequire');
    }

    public function ordermanagement()
    {
        return view('orders/orderManagement');
    }
}

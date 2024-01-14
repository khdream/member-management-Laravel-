<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class memberManagementController extends Controller
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
        return view('members/viewAllmembers');
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
    public function store(Request $request): RedirectResponse
    {
        // $companyName = $request->input('company_name');
        $allParameters = $request->all();

        // dd($allParameters) ;
        // dd($allParameters);

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'manager_name' => 'required|string|max:255',
            'furigana_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:11|min:10',
            'post_code_prefix' => 'required|string|max:3',
            '郵便番号' => 'required|string|max:4',
            'location' => 'required|string|max:255',
            'street_adress' => 'required|string|max:255',
            'building_name' => 'nullable|string|max:255',
        ]);

        
        // return redirect('/posts');

        // return redirect('/members');
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

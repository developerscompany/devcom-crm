<?php

namespace App\Http\Controllers\User;

use App\BidsCustomers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BidsCustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return request('data')['name'];

        $customer = BidsCustomers::create([
            'name' => request('data')['name'],
            'country' => request('data')['country'],
            'info' => request('data')['info'],
            'status' => request('data')['status']
        ]);

        return $customer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BidsCustomers  $bidsCustomers
     * @return \Illuminate\Http\Response
     */
    public function show(BidsCustomers $bidsCustomers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BidsCustomers  $bidsCustomers
     * @return \Illuminate\Http\Response
     */
    public function edit(BidsCustomers $bidsCustomers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BidsCustomers  $bidsCustomers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BidsCustomers $bidsCustomers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BidsCustomers  $bidsCustomers
     * @return \Illuminate\Http\Response
     */
    public function destroy(BidsCustomers $bidsCustomers)
    {
        //
    }
}

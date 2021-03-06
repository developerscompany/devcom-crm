<?php

namespace App\Http\Controllers\Admin;

use App\AdminTransaction;
use App\BankAccount;
use App\CostsType;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankAccs = BankAccount::select('title')->get();
        $costTypes = CostsType::select('title')->get();

        $users = User::select('name')->where('name', '!=', 'admin')->get();

        return view('admin.transactions.index', compact('bankAccs', 'costTypes', 'users'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminTransaction  $adminTransactions
     * @return \Illuminate\Http\Response
     */
    public function show(AdminTransaction $adminTransactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminTransaction  $adminTransactions
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminTransaction $adminTransactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminTransaction  $adminTransactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminTransaction $adminTransactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminTransaction  $adminTransactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminTransaction $adminTransactions)
    {
        //
    }
}

<?php

namespace JSGrammar\Http\Controllers;

use JSGrammar\Account;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('accounts.index');
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
     * @param  \JSGrammar\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \JSGrammar\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \JSGrammar\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \JSGrammar\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }

    public function showAccount(Request $request) {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        $accounts = Account::whereBetween('date', array($fromDate, $toDate))->orderBy('date')->get();
        $totalDebit = $accounts->sum('debit');
        $totalCredit = $accounts->sum('credit');
        return view('accounts.showAccounts', ['accounts'=>$accounts, 'totalDebit'=>$totalDebit, 'totalCredit'=>$totalCredit]);
    }
}

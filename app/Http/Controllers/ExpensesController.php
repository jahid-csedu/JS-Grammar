<?php

namespace JSGrammar\Http\Controllers;

use JSGrammar\Expense;
use JSGrammar\Account;
use JSGrammar\Teacher;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $expenses = Expense::orderBy('date', 'desc')->get();
        return view('expenses.index', ['expenses'=>$expenses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('expenses.create');
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
        $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|integer',
            'date' => 'required|date',
        ]);

        $expense = new Expense();
        if($request->type === 'Salary') {
            $expense->teacher_id = $request->teacher_id;
            $expense->month = $request->month;
            $expense->year = $request->year;
        }
        if($request->type === 'House Rent' || $request->type === 'Bill') {
            $expense->month = $request->month;
            $expense->year = $request->year;
        }
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        if($expense->save()) {
            $account = new Account();
            if($request->type === 'Salary') {
                $teacherId = $request->teacher_id;
                $teacherName = Teacher::where('id', $teacherId)->first();
                $account->description = "Salary paid to  ".$teacherName."(ID: ".$teacherId."(".$request->month."-".$request->year.")";
            }else if($request->type === 'House Rent') {
                $account->description = "House Rent paid of Month: ".$request->month."-".$request->year;
            }else if($request->type === 'Bill') {
                $account->description = "Bill paid of Month: ".$request->month."-".$request->year;
            }else{
                $account->description = $request->description;
            }
            $account->debit = $request->amount;
            $account->credit = 0;
            $account->date = $request->date;
            $account->save();
            return redirect()->route('expenses.index')->with('success', 'The information added successfully');
        }else {
            return redirect()->back()->withInput()->with('errors', 'Problem with adding the information, Please try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \JSGrammar\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \JSGrammar\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \JSGrammar\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \JSGrammar\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
        if($expense->delete()) {
            return redirect()->route('expenses.index')->with('success','The expense record was deleted successfully');
        }

        return back()->withInput()->with('errors','Problem with deleting the expense record');
    }

    public function searchExpense(Request $request) {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        $hasExpense = Expense::whereBetween('date', array($fromDate, $toDate))->first();
        if($hasExpense) {
            $expenses = Expense::whereBetween('date', array($fromDate, $toDate))->orderBy('date')->get();
            return view('expenses.index',['expenses'=>$expenses]);
        }else {
            return redirect()->route('expenses.index')->with('errors','No Expense Record Found');
        }
    }
}

<?php

namespace JSGrammar\Http\Controllers;

use JSGrammar\Fee;
use JSGrammar\Classes;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fees = Fee::all();
        return view('fees.index', ['fees'=>$fees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $classes = Classes::orderBy('class')->get();
        return view('fees.create', ['classes'=> $classes]);
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
            'class' => 'required|string|max:255',
            'admission_fee' => 'required|integer',
            'monthly_fee' => 'required|integer',
            'exam_fee' => 'required|integer'
        ]);
        $hasFees = Fee::where('class', $request->class)->first();
        if($hasFees) {
            return back()
            ->withInput()
            ->with('errors','Fees information of this class already exists');
        }
        $fee = new Fee();
        $fee->class = $request->class;
        $fee->admission_fee = $request->admission_fee;
        $fee->monthly_fee = $request->monthly_fee;
        $fee->exam_fee = $request->exam_fee;

        if($fee->save()) {
            $classes = Classes::orderBy('class')->get();
            return redirect()
                ->route('fees.index',['classes' => $classes])
                ->with('success','Fees added successfully');
        }

        return back()
            ->withInput()
            ->with('errors','Problem with adding new Fees');
    }

    /**
     * Display the specified resource.
     *
     * @param  \JSGrammar\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function show(Fee $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \JSGrammar\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function edit(Fee $fee)
    {
        //
        $classes = Classes::orderBy('class')->get();
        return view('fees.edit', ['classes'=>$classes, 'fee'=>$fee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \JSGrammar\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fee $fee)
    {
        //
        $request->validate([
            'class' => 'required|string|max:255',
            'admission_fee' => 'required|integer',
            'monthly_fee' => 'required|integer',
            'exam_fee' => 'required|integer'
        ]);
        $hasFees = Fee::where('class', $request->class)->first();
        if($hasFees) {
            return back()
            ->withInput()
            ->with('errors','Fees information of this class already exists');
        }
        $fee = Fee::find($fee->id);
        $fee->class = $request->class;
        $fee->admission_fee = $request->admission_fee;
        $fee->monthly_fee = $request->monthly_fee;
        $fee->exam_fee = $request->exam_fee;

        if($fee->save()) {
            $classes = Classes::orderBy('class')->get();
            return redirect()
                ->route('fees.index',['classes' => $classes])
                ->with('success','Fees updated successfully');
        }

        return back()
            ->withInput()
            ->with('errors','Problem with updating Fees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \JSGrammar\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fee $fee)
    {
        //
        if($fee->delete()) {
            return redirect()->route('fees.index')->with('success','The fees information was deleted successfully');
        }

        return back()->with('errors','Problem with deleting the fees information');
    }

    public function getFees(Request $request) {
        if($request->ajax()) {
            $class = $request->class;
            $fees = Fee::where('class', $class)->first();
            return $fees;
        }
    }
}

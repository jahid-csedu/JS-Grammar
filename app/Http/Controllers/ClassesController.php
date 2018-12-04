<?php

namespace JSGrammar\Http\Controllers;

use JSGrammar\Classes;
use Auth;
use DB;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::check()) {
            $classes = Classes::orderBy('class')->get();
            return view('classes.index',['classes' => $classes]);
        }

        return view('/');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(Auth::check()) {
            return view('classes.create');
        }
        return view('/');
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
        if(Auth::check()) {
            $request->validate([
                'name_english' => 'required|string|max:255',
                'name_bangla' => 'required|string|max:255',
                'class' => 'required|integer'
            ]);
            $hasClass = Classes::where('class', $request->class)->first();
            if($hasClass) {
                return back()
                ->withInput()
                ->with('errors','The class you entered already exists');
            }
            $class = new Classes();
            $class->name_english = $request->name_english;
            $class->name_bangla = $request->name_bangla;
            $class->class = $request->class;

            if($class->save()) {
                $allClasses = Classes::orderBy('class')->get();
                return redirect()
                    ->route('classes.index',['classes' => $allClasses])
                    ->with('success','Class added successfully');
            }

            return back()
                ->withInput()
                ->with('errors','Problem with adding a new class');
        }

        return view('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \JSGrammar\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \JSGrammar\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
        //
        $class = Classes::find($class->id);
        return view('classes.edit',['class'=>$class]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \JSGrammar\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $class)
    {
        //
        $request->validate([
            'name_english' => 'required|string|max:255',
            'name_bangla' => 'required|string|max:255',
            'class' => 'required|integer'
        ]);
        $class = Classes::find($class->id);
        $class->name_english = $request->name_english;
        $class->name_bangla = $request->name_bangla;
        $class->class = $request->class;

        if($class->save()) {
            $allClasses = Classes::orderBy('class')->get();
            return redirect()
                ->route('classes.index',['classes' => $allClasses])
                ->with('success','Class updated successfully');
        }

        return back()
            ->withInput()
            ->with('errors','Problem with updating the class');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \JSGrammar\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class)
    {
        //
        if($class->delete()) {
            return redirect()->route('classes.index')->with('success','The class was deleted successfully');
        }

        return back()->with('errors','Problem with deleting the class');
    }
}

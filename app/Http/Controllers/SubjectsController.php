<?php

namespace JSGrammar\Http\Controllers;

use JSGrammar\Subject;
use JSGrammar\Classes;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subjects = Subject::orderBy('class', 'code')->get();
        return view('subjects.index', ['subjects'=>$subjects]);
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
        return view('subjects.create', ['classes'=>$classes]);
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
            'name' => 'required|string|max:255',
            'paper' => 'nullable|string',
            'class' => 'required|string',
            'code' => 'required|integer'
        ]);
        $hasSubject = Subject::where(['class'=>$request->class, 'name'=>$request->name, 'code'=>$request->code])->first();
        if($hasSubject) {
            return back()
            ->withInput()
            ->with('errors','The subject already exists');
        }
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->paper = $request->paper;
        $subject->class = $request->class;
        $subject->code = $request->code;

        if($subject->save()) {
            $subjects = Subject::orderBy('class', 'code')->get();
            return redirect()
                ->route('subjects.index',['subjects' => $subjects])
                ->with('success','Subject added successfully');
        }

        return back()
            ->withInput()
            ->with('errors','Problem with adding a new Subject');
    }

    /**
     * Display the specified resource.
     *
     * @param  \JSGrammar\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \JSGrammar\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
        $classes = Classes::orderBy('class')->get();
        return view('subjects.edit', ['classes'=>$classes, 'subject'=>$subject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \JSGrammar\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'paper' => 'nullable|string',
            'class' => 'required|string',
            'code' => 'required|integer'
        ]);
        $hasSubject = Subject::where(['class'=>$request->class, 'name'=>$request->name, 'code'=>$request->code])->first();
        if($hasSubject) {
            return back()
            ->withInput()
            ->with('errors','The subject already exists');
        }
        $subject = Subject::find($subject->id);
        $subject->name = $request->name;
        $subject->paper = $request->paper;
        $subject->class = $request->class;
        $subject->code = $request->code;

        if($subject->save()) {
            $subjects = Subject::orderBy('class', 'code')->get();
            return redirect()
                ->route('subjects.index',['subjects' => $subjects])
                ->with('success','Subject updated successfully');
        }

        return back()
            ->withInput()
            ->with('errors','Problem with updating the Subject');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \JSGrammar\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
        if($subject->delete()) {
            return redirect()->route('subjects.index')->with('success','The subject was deleted successfully');
        }

        return back()->with('errors','Problem with deleting the subject');
    }
}

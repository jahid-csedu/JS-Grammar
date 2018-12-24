<?php

namespace JSGrammar\Http\Controllers;

use JSGrammar\Exam;
use JSGrammar\Classes;
use JSGrammar\Section;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $exams = Exam::all();
        return view('exams.index', ['exams'=>$exams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('exams.create');
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
            'name_english' => 'required|string|max:255',
            'name_bangla' => 'required|string|max:255',
            'weight' => 'required|integer'
        ]);

        $hasExam = Exam::where('name_english', $request->name_english)->first();
        if($hasExam) {
            return back()->withInput()->with('errors','This exam information already exists');
        }

        $exam = new Exam();
        $exam->name_english = $request->name_english;
        $exam->name_bangla = $request->name_bangla;
        $exam->weight = $request->weight;

        if($exam->save()) {
            return redirect()->route('exams.index',['exams'=>Exam::all()])
                ->with('success','The exam was added successfully');
        }

        return back()->withInput()->with('errors','Problem with adding a new exam');
    }

    /**
     * Display the specified resource.
     *
     * @param  \JSGrammar\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \JSGrammar\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
        return view('exams.edit', ['exam'=>$exam]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \JSGrammar\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
        $request->validate([
            'name_english' => 'required|string|max:255',
            'name_bangla' => 'required|string|max:255',
            'weight' => 'required|integer'
        ]);

        $exam = Exam::find($exam->id);
        $exam->name_english = $request->name_english;
        $exam->name_bangla = $request->name_bangla;
        $exam->weight = $request->weight;

        if($exam->save()) {
            return redirect()->route('exams.index', ['exams'=>Exam::all()])
                ->with('success','The exam was updated successfully');
        }

        return back()->withInput()->with('errors','Problem with updating the exam');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \JSGrammar\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
        if($exam->delete()) {
            return redirect()->route('exams.index')->with('success','The exam was deleted successfully');
        }

        return back()->withInput()->with('errors','Problem with deleting the exam');
    }

    public function getExams(Request $request) {
        if($request->ajax()) {
            $exams = Exam::all();
            return $exams;
        }
    }

    public function getExamId(Request $request) {
        if($request->ajax()) {
            $examId = Exam::select('id')->where('name_english', $request->exam)->first();
            return $examId;
        }
    }

}

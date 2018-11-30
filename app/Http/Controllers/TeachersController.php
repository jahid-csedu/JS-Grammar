<?php

namespace JSGrammar\Http\Controllers;

use JSGrammar\Teacher;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teachers = Teacher::all();
        //dd($teachers);
        return view('teachers.index', ['teachers'=>$teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('teachers.create');
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
            'present_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'designation' => 'required|string|max:255',
            'blood_group' => ['nullable', 'regex:/(A|B|AB|O)[+-]/'],
            'dob' => 'nullable|date'
        ]);
        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->present_address = $request->present_address;
        $teacher->permanent_address = $request->permanent_address;
        $teacher->phone = $request->phone;
        $teacher->designation = $request->designation;
        $teacher->dob = $request->dob;
        $teacher->blood_group = $request->blood_group;

        //Generating Teacher ID
        $lastTeacher = Teacher::orderBy('created_at','desc')->first();
        //dump((int)substr($lastTeacher->id,5));
        $id=null;
        if($lastTeacher) {
            $idNumber = (int)substr($lastTeacher->id,6)+1;
            if($idNumber<10) {
                $id = '11'.Date('Y').'0'.$idNumber;
            }else {
                $id = '11'.Date('Y').$idNumber;
            }
        }else {
            $idNumber=1;
            $id = '11'.Date('Y').'0'.$idNumber;
        }

        $teacher->id = $id;

        //Uploading Photo
        if($request->hasFile('photo')) {
            $request->file('photo')->storeAs('public/photos',$id);
            $teacher->photo = $id;
        }


        if($teacher->save()) {
            return redirect()->route('teachers.index',['teachers'=>Teacher::all()])
                ->with('success','The teacher was added successfully with ID "'.$id.'"');
        }

        return back()->withInput()->with('errors','Problem with adding a new teacher');
    }

    /**
     * Display the specified resource.
     *
     * @param  \JSGrammar\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
        $teacher = Teacher::find($teacher->id);
        return view('teachers.show', ['teacher'=>$teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \JSGrammar\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
        $teacher = Teacher::find($teacher->id);
        return view('teachers.edit', ['teacher'=>$teacher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \JSGrammar\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'present_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'designation' => 'required|string|max:255',
            'blood_group' => ['nullable', 'regex:/(A|B|AB|O)[+-]/'],
            'dob' => 'nullable|date'
        ]);
        $teacher = Teacher::find($teacher->id);
        $teacher->name = $request->name;
        $teacher->present_address = $request->present_address;
        $teacher->permanent_address = $request->permanent_address;
        $teacher->phone = $request->phone;
        $teacher->designation = $request->designation;
        $teacher->dob = $request->dob;
        $teacher->blood_group = $request->blood_group;

        //Uploading Photo
        if($request->hasFile('photo')) {
            $request->file('photo')->storeAs('public/photos',$teacher->id);
            $teacher->photo = $teacher->id;
        }


        if($teacher->save()) {
            return redirect()->route('teachers.show',['teacher'=>$teacher])
                ->with('success','The teacher was updated successfully');
        }

        return back()->withInput()->with('errors','Problem with updating the teacher');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \JSGrammar\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
        if($teacher->delete()) {
            return redirect()->route('teachers.index')->with('success','The teacher was deleted successfully');
        }

        return back()->withInput()->with('errors','Problem with deleting the teacher');
    }

    public function searchTeacher(Request $request) {
        $teacherId = $request->teacher_id;
        $teacher = Teacher::find($teacherId);
        if($teacher) {
            return redirect()->route('teachers.show', $teacher);
        }else {
            return redirect()->route('teachers.index')->with('errors','No Teacher found with this ID');
        }
    }
}

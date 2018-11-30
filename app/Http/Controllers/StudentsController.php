<?php

namespace JSGrammar\Http\Controllers;

use JSGrammar\Student;
use JSGrammar\Classes;
use JSGrammar\Section;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = Student::where('academic_year', Date('Y'))->orderBy('class')->get();
        $classes = Classes::all();
        $sections = Section::all();
        return view('student.index',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $classes = Classes::all();
        return view('student.create',['classes'=>$classes]);
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
            'name_bangla' => 'required|string|max:255',
            'name_english' => 'required|string|max:255',
            'father_name_bangla' => 'required|string|max:255',
            'father_name_english' => 'required|string|max:255',
            'father_profession' => 'nullable|string|max:255',
            'father_phone' => 'nullable|regex:/(01)[0-9]{9}/',
            'mother_name_bangla' => 'required|string|max:255',
            'mother_name_english' => 'required|string|max:255',
            'mother_profession' => 'nullable|string|max:255',
            'mother_phone' => 'nullable|regex:/(01)[0-9]{9}/',
            'present_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'academic_year' => 'integer|regex:/(20)[0-9]{2}/',
            'class' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'previous_institute' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'blood_group' => ['nullable', 'regex:/(A|B|AB|O)[+-]/']
        ]);

        $student = new Student();
        $student->name_bangla = $request->name_bangla;
        $student->name_english = $request->name_english;
        $student->father_name_bangla = $request->father_name_bangla;
        $student->father_name_english = $request->father_name_english;
        $student->father_profession = $request->father_profession;
        $student->father_phone = $request->father_phone;
        $student->mother_name_bangla = $request->mother_name_bangla;
        $student->mother_name_english = $request->mother_name_english;
        $student->mother_profession = $request->mother_profession;
        $student->mother_phone = $request->mother_phone;
        $student->present_address = $request->present_address;
        $student->permanent_address = $request->permanent_address;
        $student->academic_year = $request->academic_year;
        $student->class = $request->class;
        $student->section = $request->section;
        $student->previous_institute = $request->previous_institute;
        $student->dob = $request->dob;
        $student->blood_group = $request->blood_group;

        //generating the Student ID[10{academic year}{class}{serial}]
        $classObject = Classes::where('name_english',$request->class)->first();
        $class = $classObject->class;
        $lastStudent = Student::where(['class' => $request->class, 'academic_year' => $request->academic_year])->orderBy('created_at','desc')->first();
        $year = substr($request->academic_year,2);
        $id=null;
        if($lastStudent) {//if previous student exists of this class
            $lastId = $lastStudent->id;
            $idSerial = (int)substr($lastId, 8)+1;
            if($idSerial<10) {
                if($class <10) {
                    $id = '1'.$year.'0'.$class.'0'.$idSerial;
                }else {
                    $id = '1'.$year.$class.'0'.$idSerial;
                }
            }else {
                if($class <10) {
                    $id = '1'.$year.'0'.$class.$idSerial;
                }else {
                    $id = '1'.$year.$class.$idSerial;
                }
            }
        }else {//if no previous student exists of this class
            $idSerial = 1;
            if($class <10) {
                $id = '1'.$year.'0'.$class.'0'.$idSerial;
            }else {
                $id = '1'.$year.$class.'0'.$idSerial;
            }
        }

        $student->id = $id;

        //file Upload
        if($request->hasFile('photo')) {
            $request->file('photo')->storeAs('public/photos',$id);
            $student->photo = $id;
        }

        if($student->save()) {
            return redirect()->route('students.index',['students'=>Student::all()])
                ->with('success','The student was added successfully with ID "'.$id.'"');
        }

        return back()->withInput()->with('errors','Problem with adding a new student');
    }

    /**
     * Display the specified resource.
     *
     * @param  \JSGrammar\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
        $student = Student::find($student->id);
        return view('student.show',['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \JSGrammar\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
        $classes = Classes::all();
        $sections = Section::all();
        return view('student.edit',['student'=>$student, 'classes'=>$classes, 'sections'=>$sections]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \JSGrammar\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
        $request->validate([
            'name_bangla' => 'required|string|max:255',
            'name_english' => 'required|string|max:255',
            'father_name_bangla' => 'required|string|max:255',
            'father_name_english' => 'required|string|max:255',
            'father_profession' => 'nullable|string|max:255',
            'father_phone' => 'nullable|regex:/(01)[0-9]{9}/',
            'mother_name_bangla' => 'required|string|max:255',
            'mother_name_english' => 'required|string|max:255',
            'mother_profession' => 'nullable|string|max:255',
            'mother_phone' => 'nullable|regex:/(01)[0-9]{9}/',
            'present_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'academic_year' => 'integer|regex:/(20)[0-9]{2}/',
            'class' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'previous_institute' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'blood_group' => ['nullable', 'regex:/(A|B|AB|O)[+-]/']
        ]);

        $student = Student::find($student->id);
        $student->name_bangla = $request->name_bangla;
        $student->name_english = $request->name_english;
        $student->father_name_bangla = $request->father_name_bangla;
        $student->father_name_english = $request->father_name_english;
        $student->father_profession = $request->father_profession;
        $student->father_phone = $request->father_phone;
        $student->mother_name_bangla = $request->mother_name_bangla;
        $student->mother_name_english = $request->mother_name_english;
        $student->mother_profession = $request->mother_profession;
        $student->mother_phone = $request->mother_phone;
        $student->present_address = $request->present_address;
        $student->permanent_address = $request->permanent_address;
        $student->academic_year = $request->academic_year;
        $student->class = $request->class;
        $student->section = $request->section;
        $student->previous_institute = $request->previous_institute;
        $student->dob = $request->dob;
        $student->blood_group = $request->blood_group;

        //file Upload
        if($request->hasFile('photo')) {
            $request->file('photo')->storeAs('public/photos',$student->id);
            $student->photo = $student->id;
        }


        if($student->save()) {
            return redirect()->route('students.show',['student'=>$student])
                ->with('success','The student was updated successfully');
        }

        return back()->withInput()->with('errors','Problem with updating the student, Please Try again');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \JSGrammar\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
        //$student = Student::find($student->id);
        if($student->delete()) {
            return redirect()->route('students.index')->with('success','The student was deleted successfully');
        }

        return back()->withInput()->with('errors','Problem with deleting the student');
    }

    public function showFees() {
        $students = Student::orderBy('class','desc')->get();
        $classes = Classes::all();
        $sections = Section::all();
        return view('fees.multiple_student_fees',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
    }

    public function searchFees(Request $request) {
        $searchType = $request->searchType;
        if($searchType==="Search By Student ID") {
            $studentId = $request->student_id;
            $student = Student::find($studentId);
            if($student) {
                $classes = Classes::all();
                $sections = Section::all();
                return view('fees.single_student_fees',['student'=>$student, 'classes'=>$classes, 'sections'=>$sections]);
            }else {
                $students = Student::orderBy('class','desc')->get();
                $classes = Classes::all();
                $sections = Section::all();
                return view('fees.multiple_student_fees',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
            }
        }else if($searchType==="Search By Class") {
            $class = $request->class;
            $section = $request->section;
            if($section==="All") {
                $hasStudent = Student::where('class', $class)->get()->first();
                if($hasStudent) {
                    $students = Student::where('class', $class)->get();
                    $classes = Classes::all();
                    $sections = Section::all();
                    return view('fees.multiple_student_fees',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
                }else {
                    $students = Student::orderBy('class','desc')->get();
                    $classes = Classes::all();
                    $sections = Section::all();
                    return view('fees.multiple_student_fees',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
                }
            }else {
                $hasStudent = Student::where(['class'=>$class, 'section'=>$section])->get()->first();
                if($hasStudent) {
                    $students = Student::where(['class'=>$class, 'section'=>$section])->get();
                    $classes = Classes::all();
                    $sections = Section::all();
                    return view('fees.multiple_student_fees',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
                }else {
                    $students = Student::orderBy('class','desc')->get();
                    $classes = Classes::all();
                    $sections = Section::all();
                    return view('fees.multiple_student_fees',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
                }
            }
        }
    }

    public function searchStudents(Request $request) {
        $searchType = $request->searchType;
        if($searchType==="Search By Student ID") {
            $studentId = $request->student_id;
            $student = Student::find($studentId);
            if($student) {
                return redirect()->route('students.show', $student);
            }else {
                return redirect()->route('students.index')->with('errors','No Student found with this ID');
            }
        }else if($searchType==="Search By Class") {
            $academicYear = $request->academic_year;
            $class = $request->class;
            $section = $request->section;
            if($section==="All"){
                $hasStudent = Student::where(['academic_year' => $academicYear, 'class' => $class])->get()->first();
                if($hasStudent) {
                    $students = Student::where(['class' => $class, 'academic_year' => $academicYear])->get();
                    $classes = Classes::all();
                    $sections = Section::all();
                    return view('student.index',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
                }else {
                    return redirect()->route('students.index')->with('errors','No Student found');
                }
            }else {
                $hasStudent = Student::where(['academic_year' => $academicYear, 'class'=>$class, 'section'=>$section])->get()->first();
                if($hasStudent) {
                    $students = Student::where(['academic_year' => $academicYear, 'class'=>$class, 'section'=>$section])->get();
                    $classes = Classes::all();
                    $sections = Section::all();
                    return view('student.index',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
                }else {
                    return redirect()->route('students.index')->with('errors','No Student found');
                }
            }
        }
    }

}

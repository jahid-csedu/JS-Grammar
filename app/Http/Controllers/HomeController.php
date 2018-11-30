<?php

namespace JSGrammar\Http\Controllers;

use Illuminate\Http\Request;
use JSGrammar\Student;
use JSGrammar\Teacher;
use JSGrammar\Classes;
use JSGrammar\Section;
use JSGrammar\Payment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalStudent = Student::count();
        $totalTeachers = Teacher::count();
        $totalClasses = Classes::count();
        $totalSections = Section::count();
        $payments = Payment::whereMonth('date', Date('m'))->get();
        return view('home', ['student'=>$totalStudent, 'teacher'=>$totalTeachers, 'class'=>$totalClasses, 'section'=>$totalSections, 'payments'=>$payments]);
    }
}

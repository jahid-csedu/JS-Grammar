<?php

namespace JSGrammar\Http\Controllers;

use JSGrammar\Payment;
use JSGrammar\Student;
use JSGrammar\Transaction;
use JSGrammar\Exam;
use JSGrammar\StudentPayment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payments = Payment::orderBy('date', 'desc')->get();
        return view('payments.index', ['payments'=>$payments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $exams = Exam::all();
        return view('payments.create', ['exams'=>$exams]);
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
            'student_id' => 'required|string|max:255',
            'paid_amount' => 'required|integer',
            'payment_due' => 'required|integer',
            'date' => 'required|date'
        ]);

        $studentId = $request->student_id;
        $student = Student::find($studentId);
        if($student){

            $months = $request->input('months');
            $admission = $request->input('admission');
            $exams = $request->input('exams');
            //generate trx ID
            $trx = Transaction::select('id')->orderBy('created_at', 'desc')->first();
            if($trx) {
              $trxId = $trx->id+1;
            }else {
              $trxId = 1;
            }
            //modify description and add to student_payments table
            $description = "Payment collected from student ".$studentId." --";
            if($admission) {
                $description .= "Admission Fee-". date('y').", ";
                $studentPayment = new StudentPayment();
                $studentPayment->student_id = $studentId;
                $studentPayment->type = "Admission Fee";
                $studentPayment->trx_id = $trxId;
                $studentPayment->year = date('y');
                $studentPayment->save();
            }
            if($months) {
                foreach($months as $month) {
                    $description .= $month."-". date('y').", ";
                    $studentPayment = new StudentPayment();
                    $studentPayment->student_id = $studentId;
                    $studentPayment->type = "Monthly Fee";
                    $studentPayment->trx_id = $trxId;
                    $studentPayment->month = $month;
                    $studentPayment->year = date('y');
                    $studentPayment->save();
                }
            }
            if($exams) {
                foreach($exams as $exam) {
                    $description .= $exam."-". date('y').", ";
                    $studentPayment = new StudentPayment();
                    $studentPayment->student_id = $studentId;
                    $studentPayment->type = "Exam Fee";
                    $studentPayment->trx_id = $trxId;
                    $studentPayment->exam_name = $exam;
                    $studentPayment->year = date('y');
                    $studentPayment->save();
                }
            }
            if($request->current_amount < $request->paid_amount) {
                $description .= "Due Collection";
            }
            $payment = new Payment();
            $payment->student_id = $studentId;
            $payment->trx_id = $trxId;
            $payment->description = $description;
            $payment->amount = $request->paid_amount;
            $payment->date = $request->date;
            if($payment->save()) {
                //Save a record in transaction table
                $transaction = new Transaction();
                $transaction->id = $trxId;
                $transaction->date = $request->date;
                $transaction->description = $description;
                $transaction->credit = $request->paid_amount;
                $transaction->save();
                //update due 
                $student = Student::find($studentId);
                $student->due = $request->payment_due;
                $student->save();

                return redirect()->route('payments.index')->with('success', 'The Payment information added successfully');
            }
            return redirect()->back()->withInput()->with('errors', 'Problem with adding the Payment information, Please try again');
        }else{
            return redirect()->back()->withInput()->with('errors', 'The Student ID is not valid');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \JSGrammar\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \JSGrammar\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \JSGrammar\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \JSGrammar\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function searchPayment(Request $request) {
        $searchType = $request->searchType;
        if($searchType==="Search By Student ID") {
            $studentId = $request->student_id;
            $student = Student::find($studentId);
            if($student) {
                $payments = Payment::where('student_id', $studentId)->orderBy('date')->get();
                return view('payments.index', ['payments'=>$payments]);
            }else {
                return redirect()->route('payments.index')->with('errors','No Student found with this ID');
            }
        }else if($searchType==="Search By Date") {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;

            $hasPayment = Payment::whereBetween('date', array($fromDate, $toDate))->first();
            if($hasPayment) {
                $payments = Payment::whereBetween('date', array($fromDate, $toDate))->orderBy('date')->get();
                return view('payments.index',['payments'=>$payments]);
            }else {
                return redirect()->route('payments.index')->with('errors','No Payment Record Found');
            }
        }
    }

    public function getPayments(Request $request) {
        $studentId = $request->student_id;
        $payments = StudentPayment::where('student_id', $studentId)->get();
        return $payments;
    }
}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {

	Route::resource('students','StudentsController');
	Route::resource('classes','ClassesController');
	Route::resource('sections','SectionsController');
	Route::resource('teachers','TeachersController');
	Route::resource('exams','ExamsController');
	Route::resource('results','ResultsController');
	Route::resource('payments','PaymentsController');
	Route::resource('expenses', 'ExpensesController');
	Route::resource('fees', 'FeesController');
	Route::resource('subjects', 'SubjectsController');
	Route::resource('users', 'UsersController');

	Route::post('searchFees','StudentsController@searchFees');
	Route::post('searchStudents','StudentsController@searchStudents');
	Route::post('searchTeachers','TeachersController@searchTeacher');
	Route::post('searchPayments','PaymentsController@searchPayment');
	Route::post('searchExpenses','ExpensesController@searchExpense');
	Route::post('searchExams','ExamsController@searchExam');
	Route::get('showResult','ResultsController@showResult');
	Route::get('getSections', 'SectionsController@getSections');
	Route::get('getStudent', 'StudentsController@getStudent');
	Route::get('getStudentID', 'StudentsController@searchID');
	Route::get('getTeacherID', 'TeachersController@searchTeacherID');
	Route::get('getExams', 'ExamsController@getExams');
	Route::get('getFees', 'FeesController@getFees');
	Route::get('getPayments', 'PaymentsController@getPayments');
	Route::get('getExamId', 'ExamsController@getExamId');

});

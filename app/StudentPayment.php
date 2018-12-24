<?php

namespace JSGrammar;

use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    protected $fillable = [
    	'trx_id',
    	'student_id',
    	'type',
    	'month',
    	'year',
    	'exam_name'
    ];

    public function student() {
    	return $this->belongsTo('JSGrammar\Student');
    }
}

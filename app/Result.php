<?php

namespace JSGrammar;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //
    protected $table = 'results';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
    	'exam_id',
    	'student_id',
    	'marks',
    ];

    public function student() {
    	return $this->belongsTo('JSGrammar\Student');
    }

    public function exam() {
    	return $this->belongsTo('JSGrammar\Exam');
    }
}

<?php

namespace JSGrammar;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'students';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
      'id',
    	'name_bangla',
    	'name_english',
    	'father_name_bangla',
    	'father_name_english',
    	'father_profession',
    	'father_phone',
    	'mother_name_bangla',
    	'mother_name_english',
      'mother_profession',
    	'mother_phone',
    	'present_address',
    	'permanent_address',
    	'academic_year',
      'class',
      'section',
      'roll',
      'previous_institute',
      'dob',
      'blood_group',
      'admission_fee',
      'monthly_fee',
      'exam_fee',
    	'photo'
    ];

    public function class() {
    	return $this->belongsTo('JSGrammar\Classes');
    }

    public function section() {
    	return $this->belongsTo('JSGrammar\Section');
    }

    public function results() {
        return $this->hasMany('JSGrammar\Result');
    }

    public function payments() {
        return $this->hasMany('JSGrammar\Payment');
    }

}

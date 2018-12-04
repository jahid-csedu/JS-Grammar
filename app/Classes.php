<?php

namespace JSGrammar;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    //
    protected $fillable = [
      'name_bangla',
        'name_english',
    	'class'
    ];

    public function students() {
    	return $this->hasMany('JSGrammar\Student');
    }

    public function sections() {
    	return $this->hasMany('JSGrammar\Section');
    }

    public function exams() {
        return $this->hasMany('JSGrammar\Exam');
    }

    public function subjects() {
        return $this->hasMany('JSGrammar\Subject');
    }

}

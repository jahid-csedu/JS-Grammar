<?php

namespace JSGrammar;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = [
      'name_english',
    	'name_bangla',
    	'class',
    	'shift'
    ];

    public function classes() {
    	return $this->belongsTo('JSGrammar\Classes');
    }

    public function students() {
    	return $this->hasMany('JSGrammar\Student');
    }
}

<?php

namespace JSGrammar;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $fillable = [
    	'subject_name',
    	'class',
    	'subject_code'
    ];

    public function class() {
    	return $this->belongsTo('JSGrammar\Classes');
    }
}

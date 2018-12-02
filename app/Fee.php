<?php

namespace JSGrammar;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    //
    protected $fillable = [
    	'class',
    	'admission_fee',
    	'monthly_fee',
    	'exam_fee'
    ];

    public function class() {
    	return $this->belongsTo('JSGrammar\Classes');
    }
}

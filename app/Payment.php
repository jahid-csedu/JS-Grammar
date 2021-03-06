<?php

namespace JSGrammar;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $table = 'payment';
    protected $fillable = [
    	'student_id',
        'trx_id',
    	'type',
    	'month',
    	'year',
    	'description',
    	'amount',
    	'date'
    ];

    public function student() {
    	return $this->belongsTo('JSGrammar\Student');
    }
}

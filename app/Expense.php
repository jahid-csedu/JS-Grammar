<?php

namespace JSGrammar;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    protected $fillable = [
      'type',
      'teacher_id',
      'trx_id',
      'month',
      'year',
    	'description',
    	'amount',
    	'date'
    ];
}

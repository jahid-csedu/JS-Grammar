<?php

namespace JSGrammar;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    protected $fillable = [
    	'description',
    	'amount',
    	'date'
    ];
}

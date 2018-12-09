<?php

namespace JSGrammar;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
      'id',
    	'name',
    	'present_address',
    	'permanent_address',
    	'phone',
    	'designation',
    	'dob',
    	'blood_group',
    	'photo'
    ];
}

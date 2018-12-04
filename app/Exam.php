<?php

namespace JSGrammar;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //

    protected $fillable = [
    	'id',
        'name_english',
    	'name_bangla',
    	'weight'
    ];

    public function result() {
        return $this->hasMany('JSGrammar\Result');
    }
}

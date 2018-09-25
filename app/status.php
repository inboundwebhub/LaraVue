<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
	protected $fillable = [
		'body',
		'user_id',
		'author',
	];
    public function user(){
    	return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['login_id', 'email'];
}

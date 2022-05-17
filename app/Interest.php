<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['login_id', 'about', 'experience', 'need', 'offer'];
}

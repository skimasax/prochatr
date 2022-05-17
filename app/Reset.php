<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reset extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['token', 'email'];
}

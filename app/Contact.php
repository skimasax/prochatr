<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['login_id', 'name', 'email', 'subject', 'message'];
}

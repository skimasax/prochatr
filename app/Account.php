<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['login_id', 'username', 'password', 'security', 'answer'];
}

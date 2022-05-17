<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Active extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['login_id', 'pay_id'];
}

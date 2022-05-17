<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['login_id', 'connection_id'];
}

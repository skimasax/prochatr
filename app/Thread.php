<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['receiver_id', 'my_id', 'action'];
    protected $table = 'threads';
}

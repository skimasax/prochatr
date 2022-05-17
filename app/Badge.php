<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['login_id', 'Contact', 'Invite', 'Voice', 'Video', 'Messaging', 'Groups', 'Conference'];
}

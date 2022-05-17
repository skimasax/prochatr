<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal_detail extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['user_id', 'firstname', 'lastname', 'email', 'phone', 'profession', 'company', 'city', 'country', 'image', 'position', 'activity', 'state', 'cstate,', 'notfication', 'created_at'];
}

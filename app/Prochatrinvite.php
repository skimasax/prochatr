<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prochatrinvite extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['inviteid', 'name', 'email', 'image', 'count'];
}

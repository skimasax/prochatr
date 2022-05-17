<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat_info extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['chat_id', 'owner', 'prepared_for'];
    protected $table = 'chat_info';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['chat_id', 'message', 'user_id'];
    protected $table = 'chat';
}

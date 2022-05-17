<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	//Enable Mass Assignment
    protected $fillable = ['user_id', 'my_chat_color', 'others_chat_color', 'background_color', 'mail_alert', 'desktop_prompt'];
}

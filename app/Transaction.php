<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'id',
         'user_id', 
         'email',
           'amount', 
            'description', 
            'currency',
             'transaction', 'status', 'message', 'channel', 'referrer', 'domain'
        
          
             
    ];

    protected $table= "transactions";
}

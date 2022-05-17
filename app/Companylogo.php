<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companylogo extends Model
{
    protected $fillable = ['login_id', 'logo', 'website', 'status', 'created_at', 'updated_at'];

    protected $table = "company_logo";
}

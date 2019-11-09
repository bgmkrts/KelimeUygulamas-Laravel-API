<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForgotPasswordModel extends Model
{
    protected $table='forgot_passwords';
    public $timestamps='true';
    protected $fillable=[
       'email',
        'code'
    ];
}

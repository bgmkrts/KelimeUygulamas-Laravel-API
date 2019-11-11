<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class UserModel extends Model
{
    use HasApiTokens, Notifiable;
    protected $table='users';
    public $timestamps=true;
    protected $fillable=[
        'name',
        'surname',
        'password',
        'user_name',
        'email'
    ];

    public function MyWords(){
        return $this->hasMany(MyWordModel::class,'users_id','id');
    }


}

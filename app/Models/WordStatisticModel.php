<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordStatisticModel extends Model
{
    protected $table = 'words_statistics';
    public $timestamps = true;
    protected $fillable = [
        'users_id',
        'isTrue',
        'words_id',
        'my_words_id'
    ];
    public function Users(){
        return $this->hasMany(UserModel::class,'id','users_id');
    }
}

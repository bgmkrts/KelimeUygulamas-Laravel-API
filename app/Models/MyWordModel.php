<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyWordModel extends Model
{
    protected $table='my_words';
    public $timestamps=true;
    protected $fillable=[
        'words_id',
        'users_id',
        'myWord_tr',
        'myWord_eng',
        'remember_word'
    ];
    public function User(){
        return $this->belongsTo('App\Models\UserModel','users_id','id');
    }

    public function Word(){
        return $this->belongsTo(WordModel::class,'words_id','id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordModel extends Model
{
    protected $table='words';
    public $timestamps=true;
    protected $fillable=[

        'word_tr',
        'word_eng',
        'degreeOfDifficulty'
    ];

}


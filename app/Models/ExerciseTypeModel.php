<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseTypeModel extends Model
{
    protected $table='exercise_types';
    public $timestamps=true;
    protected $fillable=[
        'exercises_name'
    ];
}

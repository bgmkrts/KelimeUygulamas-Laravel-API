<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseStatisticModel extends Model
{
    protected $table='exercises_statistics';
    public $timestamps=true;
    protected $fillable=[
        'users_id',
        'exercise_types_id',
        'point'
    ];
    public function Users(){
        return $this->hasMany(UserModel::class,'id','users_id');
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\ExerciseStatisticModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
class ExerciseStatisticController extends Controller
{
    public function index(){
        $user = auth('api')->user();
        $exercises_statistics_avg=ExerciseStatisticModel::where("users_id",$user->id)->with('Users')->get();
        return Response::json([
            'avg'=>$exercises_statistics_avg,
        ]);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'users_id'=>'',
            'exercise_types_id'=>'required',
            'point'=>''
            ]);
        $exercises_statistics=new ExerciseStatisticModel();
        $exercises_statistics->exercise_types_id=$request->exercise_types_id;
        $exercises_statistics->users_id=$request->users_id;
        $exercises_statistics->point=$request->point;
        $exercises_statistics->save();
        return Response::json([
            'result'=>'statistics created'
        ]);

    }
}
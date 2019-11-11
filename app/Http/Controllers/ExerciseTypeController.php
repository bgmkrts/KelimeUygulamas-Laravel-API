<?php

namespace App\Http\Controllers;

use App\Models\ExerciseTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ExerciseTypeController extends Controller
{
    public function index(){
        $exercise_types=ExerciseTypeModel::all();
        return Response::json([
            'result'=>'Exercises listed',
            'data'=>$exercise_types,
        ]);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exercises_name' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = array();
            foreach ($validator->errors()->messages() as $key => $value) {
                $errors[] = [
                    'field' => $key,
                    'message' => $value[0]
                ];
            }
            return Response::json([
                'result' => 'Error',
                "code" => "10",
                'errors' => $errors,
            ]);
        }
        $exercise_types = new ExerciseTypeModel();
        $exercise_types->exercises_name = $request->exercises_name;
        $exercise_types->save();
        return Response::json([
            'result' => 'Exercise created'
        ]);
    }

}

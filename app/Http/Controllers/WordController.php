<?php

namespace App\Http\Controllers;
use App\Models\MyWordModel;
use App\Models\WordModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class WordController extends Controller
{
    public function index($degreeOfDifficulty)
    {
        $words = WordModel::inRandomOrder()->where('degreeOfDifficulty',$degreeOfDifficulty)->take(4)->get();
        return Response::json([
            'data' => $words
        ]);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'word_tr' => 'required',
            'word_eng' => 'required',
            'degreeOfDifficulty' => 'required',
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
        $words = new WordModel();
        $words->word_tr = $request->word_tr;
        $words->word_eng = $request->word_eng;
        $words->degreeOfDifficulty = $request->degreeOfDifficulty;
        $words->save();
        return Response::json([
            "message"=>"Word created",

        ]);

    }
    public function updateWord(Request $request){

        $validator = Validator::make($request->all(), [
            'word_tr' => 'required',
            'word_eng' => 'required',
            'degreeOfDifficulty' => 'required',
        ]);
            $words = WordModel::find($request->id);
            $words ->id=$request->id;
            $words->word_tr=$request->word_tr;
            $words->word_eng=$request->word_eng;
            $words->degreeOfDifficulty = $request->degreeOfDifficulty;
            $words->save();
            return Response::json([
                'result'=>'Word updated'
            ]);
        }

    public function removeWord($id)
    {
        $words = WordModel::find($id);
        if ($words != null) {
            $words->delete();
            return Response::json([
                'message' => 'word removed',
            ]);
        }
        else{
            return response()->json([
                'message' => 'error',
            ]);
        }
    }
}

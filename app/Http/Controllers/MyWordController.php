<?php

namespace App\Http\Controllers;

use App\Models\MyWordModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class MyWordController extends Controller
{
    public function index()
    {
        $user = auth('api')->user();
        $my_words = UserModel:: with('MyWords.Word')->findOrFail($user->id);
        return Response::json([
            'data' => $my_words
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'words_id' => '',
            'users_id' => 'required',
            'myWord_tr' => '',
            'myWord_eng' => '',
            'remember_word' => ''
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
        $my_words = new MyWordModel();
        $my_words->words_id = $request->words_id;
        $my_words->users_id = $request->users_id;
        $my_words->myWord_tr = $request->myWord_tr;
        $my_words->myWord_eng = $request->myWord_eng;
        $my_words->remember_word = $request->remember_word;
        $my_words->save();
        return Response::json([
            'result' => 'Myword created'
        ]);
    }
   public function updateMyWord(Request $request){
       $validator = Validator::make($request->all(), [
           'words_id' => '',
           'users_id' => 'required',
           'myWord_tr' => 'required',
           'myWord_eng' => 'required',
           'remember_word' => ''
       ]);
       $my_words = MyWordModel::find($request->id);
       $my_words ->id=$request->id;
       $my_words->myWord_tr=$request->myWord_tr;
       $my_words->myWord_eng=$request->myWord_eng;
       $my_words->remember_word=$request->remember_word;
       $my_words->save();
       return Response::json([
           'result'=>'Myword updated'
       ]);

   }
    public function removeMyWord($id)
    {
        $my_words = MyWordModel::find($id);
        if($my_words!=null) {
            $my_words->delete();
            return Response::json([
                'message' => 'Myword removed',
            ]);
        }
        else{
            return response()->json([
                'message' => 'error',
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\WordStatisticModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class WordStatisticController extends Controller
{
    public function index(){
        $user = auth('api')->user();
        $words_statistics=WordStatisticModel::where("users_id",$user->id)->with('Users')->get();
        return Response::json([
            'data'=>$words_statistics
        ]);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'users_id'=>'',
            'isTrue'=>'required',
            'words_id'=>'required',
            'my_words_id'=>''
            ]);
        $user = auth('api')->user();
        $words_statistics=new WordStatisticModel();
        $words_statistics->users_id=$user->id;
        $words_statistics->isTrue=$request->isTrue;
        if($request->words_id){
            $words_statistics->words_id=$request->words_id;
        }
        else{ $words_statistics->my_words_id=$request->my_words_id;
        }
        $words_statistics->save();
        return Response::json([
            'result'=>'wordstatistic created'
        ]);

}
}

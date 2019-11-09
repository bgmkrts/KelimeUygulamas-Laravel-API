<?php

namespace App\Http\Controllers;
use App\Models\WordModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WordController extends Controller
{
    public function create($request){
        $words=new WordModel();
        $words->word_tr=$request->word_tr;
        $words->word_eng=$request->word_eng;
        $words->degreeOfDifficult=$request->degreeOfDifficult;
        $words->save();
        return Response::json([
            'result'=>'ok'
        ]);
    }
}

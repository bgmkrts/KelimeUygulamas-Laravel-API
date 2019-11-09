<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        $users=UserModel::all();
        return Response::json([
            'result'=>'ok',
            'data'=>$users
        ]);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'surname'=>'required',
            'password'=>'required|min:8',
            'user_name'=>'required|unique:users',
            'email'=>'required|unique:users'
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
        $users=new UserModel();
        $users->name=$request->name;
        $users->surname=$request->surname;
        $users->user_name=$request->user_name;
        $users->password = Hash::make($request->password);
        $users->email=$request->email;
        $users->save();
        return Response::json([
            "result"=>"ok",
            "message"=>"başarılı kayıt",
            "user"=> $users,
            "token" => $users->createToken("token")->accessToken
        ]);

    }
}

<?php
namespace App\Http\Controllers;
use App\Models\ForgotPasswordModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        /*$validatedData = $request->validate([
          'email' => 'required|email|exists:users',
        ]);*/

        $validator= Validator::make($request->all(), [
            'email'=>'required|email|exists:users'
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

        $user = UserModel::where("email", $request->email)->first();
        if (isset($user)) {
            $code  = rand(1000000, 99999999);
            $forgot_password = new ForgotPasswordModel();
            $forgot_password->email = $request->email;
            $forgot_password->code =$code ;
            $forgot_password->save();
            $home  =new HomeController();
            $home->mail($request->email,$code,$user->name);
            return Response::json([
                'result'=>'mail gönderildi'
            ]);
        }
        else {
                  return Response::json([
                      'result'=>'Böyle bir kullanıcı yok'
                  ]);
        }
    }


    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'code' => 'required',
            'password' => 'required',
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
        $model = ForgotPasswordModel::where("email", $request->email)->where("code", $request->code)->first();

        if (isset($model)) {
            $user =UserModel::where("email", $request->email)->first();
            $user->update([
                "password" => Hash::make($request->password)
            ]);
            return Response::json([
                'result'=>'Başarılı'
            ]);
        }
        else {
            return Response::json([
                'result'=>'Böyle bir kayıt yok'
            ]);
        }
    }
}

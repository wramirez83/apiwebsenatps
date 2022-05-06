<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Module\Validate;
use App\Modules\Module\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $res){
        //Validamos que la petición contenga los datos necesario para el login
        $validator = Validate::validateLogin($res);

        if($validator->fails())
            return response()->json($validator->errors());
        if(Auth::attempt($res->all())){
            $token = base64_encode($res->email . date('Y-m-d'));
            User::whereEmail($res->email)->first()->update([
                'remember_token' => $token
            ]);
            return response()->json(['token' => $token, 'date' =>  date('Y-m-d H:i:s')]);
        }else{
            return response()->json(['error' =>'Credenciales incorrectas']);
        }
        
    }

    public function formLogin(){
        return view('login');
    }

    public function loginWeb(Request $res){
        $validator = Validate::validateLogin($res);
        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors());
        
        if(Auth::attempt($res->except(['_token']))){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->withErrors($validator->errors());
        }
    }
}

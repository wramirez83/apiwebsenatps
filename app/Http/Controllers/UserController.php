<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /* This is a function that is receiving a request from the user. */
    public function register(Request $res){
        /* Validating the request and fields */
        $validate = $res->validate([
            'nameuser' => 'required',
            'email' => 'required',
            'password' => 'required|min:4'
        ],
        [
            'nameuser.required' => 'El campo de nombre es obligatorio',
            'email.required' => 'El campo de correo es obligatorio',
            'password.required' => 'El campo de clave es obligatorio',
            'password.min' =>'Campo de clave minimo debe tener 4 caracteres'
        ]);
        //validate email
                    //   User::where('email', $res->email)->first()
        $validateEmail = User::whereEmail($res->email)->first();
        if($validateEmail)
            return redirect()->back()->withInput()->withErrors(['error1' => 'El correo electronico ya está registrado']);
        
        User::create([
            'name' => $res->nameuser,
            'email' => $res->email,
            'password' => bcrypt($res->password)
        ]);
        
        return redirect()->back()->with('msg', 'El registro se ha guardado');

    }

    public function getAll(){
        return response()->json(User::all());
    }
    
    public function getUser(Request $res){
        $validate = Validator::make( $res->all(),
            [
                'id' => 'required'
            ]
        );
        if($validate->fails())
            return response()->json(['error' => 'El id es Obligatorio']);
        
        $user = User::find($res->id);
        return Response()->json($user);
    }
}

<?php
namespace App\Module;

use Illuminate\Support\Facades\Validator;

class Validate{

    public static function validateLogin($res){

        return Validator::make($res->all(), [
            'email' => 'required',
            'password' => 'required|min:4',
        ],
        [
           'email.required' => 'El campo de EMAIL es obligatorio',
           'password.required' => 'El campo de clave es obligatorio',
           'password.min' => 'El campo de clave como minimo necesita 4 caracteres',
        ]);
    }
}
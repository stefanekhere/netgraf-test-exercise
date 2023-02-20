<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('username', 'password');
 
        if (Auth::attempt($credentials)) {
            return response()->json('Successful operation', 200, 'Success');
        }
    }

    public function logout(){
        Auth::logout();
        return response()->json('Successful operation', 200, 'Success');
    }
}

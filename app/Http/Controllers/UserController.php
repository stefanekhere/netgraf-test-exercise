<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createUsersFromArray(Request $request){
        foreach($request as $user){
            User::create([
                'id' => $user->id,
                'username' => $user->username,
                'firstName' => $user->firstName,
                'lastName' => $user->lastName,
                'email' => $user->email,
                'password' => Hash::make($user->password),
                'phone' => $user->phone,
                'userStatus' => $user->userStatus,
            ]);
        }
        return response()->json('Successful operation', 200, 'Success');
    }

    public function getUserByUsername($username){
        return User::where('username', $username)->first();
    }

    public function update(Request $request, $username){
        User::where('username', $username)->update([
            'id' => $request->id,
            'username' => $request->username,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'userStatus' => $request->userStatus,
        ]);
        return response()->json('Successful operation', 200, 'Success');
    }

    public function delete($username){
        User::where('username', $username)->first()->forceDelete();
        return response()->json('Successful operation', 200, 'Success');
    }

    public function store(Request $request){
        User::create([
            'id' => $request->id,
            'username' => $request->username,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'userStatus' => $request->userStatus,
        ]);
    }
}

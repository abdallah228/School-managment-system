<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    //
    
    public function register(Request $request)
    {
        $validate_data = $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|confirmed',
        ]);
        $validate_data['password'] = bcrypt($request->password);
        $user = User::create($validate_data);
        $access_token = $user->createToken('authToken')->accessToken;
        return response(['user'=>$user , 'access_token'=>$access_token]);


    }//end register
    public function login(Request $request)
    {   
        $login_data = $request->validate([
            'email'=>'email|required',
            'password'=>'required',
        ]);

        if(!auth()->attempt($login_data))
        {
            return response()->json(['msg'=>'invalid credential']);
        }
        $access_token = auth()->user()->createToken('authToken')->accessToken;
        return response()->json(['user'=>auth()->user() , 'access_token'=>$access_token]);

    }//end login

    public function logout()
    {
        //  auth()->user()->token()->revoke();//revoke
        auth()->user()->token()->delete();//delete token
    }//end function logout
}

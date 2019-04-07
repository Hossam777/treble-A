<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use Hash;

class UserHandler extends Controller
{
    public $successStatus = 200;
    //
    public function login(Request $request){
        $input = $request->all();
        $username_mail = $input['mail'];
        $password = $input['password'];
        $user = User::where('username', $username_mail)->orWhere('u_mail', $username_mail)->first();

        if($user){
            if(Hash::check($password, $user['PASSWORD']))
                return response()->json(['cod'=>'200','accesstoken' => 'token'], $this -> successStatus);
            return response()->json(['cod'=>'401','message' => 'wrong password'], $this -> successStatus);
        }
        
            return response()->json(['cod'=>'402','message' => 'wrong mail or username'], $this -> successStatus);
    }
}

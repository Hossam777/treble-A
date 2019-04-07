<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserHandler extends Controller
{
    public $successStatus = 200;
    //
    public function login(Request $request){
        $input = $request->all();
        $username_mail = $input['mail'];
        $password = $input['password'];
        $user = new User();
        $user = DB::table('users')->where(function($q) {
            $q->where('USERNAME', $username_mail)
              ->orWhere('U_MAIL', $password);
        })->first();
        if($user != null){
            return response()->json(['cod'=>'401'], $this -> successStatus);
        }
        if(Hash::make($user->password) == $password){
            return response()->json(['cod' => '','200' => $user], $this -> successStatus);
        }else{
            return response()->json(['cod'=>'402'], $this -> successStatus);
        }
    }
}

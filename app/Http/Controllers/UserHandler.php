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
        
        if(Auth::attempt(['u_mail' => request('u_mail'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json($success, $this-> successStatus); 
        }
        $mail = User::where('email', request('email'))->get();

        if($mail->count())
        {
            return response()->json(['password'=> ['wrong password']], 401); 
        }
        else{ 
            return response()->json(['email'=> ['wrong mail']], 401); 
        } 
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(), [ 
            'u_mail' => 'required|email',
            'username' => 'required' ,
            'password' => 'required', 
            'c_password' => 'required|same:password', 
            'f_name' => 'required',
            'l_name' => 'required',
            'age' => 'required',
            'gender' => 'required',
        ]);
        if ($validator->fails()) 
        { 
            return response()->json($validator->errors(), 401);            
        }

        $input = $request->all();   
        $input['password'] = Hash::make($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], $this-> successStatus);
    }


    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    }


}

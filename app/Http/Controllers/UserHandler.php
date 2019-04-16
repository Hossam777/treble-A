<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\skill as UserSkills;
use App\followed_user as FollowUser;
use App\followed_comany as FollowCompany;
use App\quiz as Quiz; 
use Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserHandler extends Controller
{
    public $successStatus = 200;
    //
    public function Login(Request $request){
        $input = $request->all();
        $username_mail = $input['mail'];
        $password = $input['password'];
        $user = User::where('username', $username_mail)->orWhere('u_mail', $username_mail)->first();
        
        if($user == null){
            return response()->json(['email'=> ['wrong mail or username']], 401); 
        }
        else if(!Hash::check($input['password'], $user['password']))
        {
            return response()->json(['password'=> ['wrong password']], 401); 
        }
        else{
            $success['token'] =  $user->createToken($user['u_mail'])-> accessToken;
            $user['remember_token'] = $success['token'];
            $user->save();
            $success['username'] =  $user['username'];
            return response()->json(['success' => $success], $this-> successStatus);      
        } 
    }
    public function Register(Request $request){
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
         
        $success['token'] =  $user->createToken($user['u_mail'])-> accessToken;
        $user['remember_token'] = $success['token'];
        $user->save();
        $success['username'] =  $user['username'];
        return response()->json(['success'=>$success], $this-> successStatus);
    }


    public function UserData(Request $request) 
    { 
        $user = User::where('remember_token',$request['Authorization'])->first();
        if($user)
            return response()->json(['success' => $user], $this -> successStatus);
        return response()->json(['error' => 'invalid token or expired'], 401); 
    }

    public function AddSkill(Request $request){
        $user = User::where('remember_token',$request['Authorization'])->first();
        if($user){
            $validator = Validator::make($request->all(), [ 
                'skill' => 'required|string',
            ]);
            if ($validator->fails()) 
            { 
                return response()->json($validator->errors(), 401);            
            }
            $userskill = UserSkills();
            $userskill['u_mail'] = $user['u_mail'];
            $userskill['skill'] = $request['skill'];
            $userskill['score'] = '0';
            UserSkills::create($userskill);
            return response()->json(['success' => 'skill added'], 401);
        }
        return response()->json(['error' => 'invalid token or expired'], 401);
    }

    public function UpdateScore(Request $request){
        $user = User::where('remember_token',$request['Authorization'])->first();
        if($user){
            $validator = Validator::make($request->all(), [ 
                'skill' => 'required|string',
                'score' => 'required|numeric' ,
            ]);
            if ($validator->fails()) 
            { 
                return response()->json($validator->errors(), 401);            
            }
            $userskill = UserSkills::where([['u_mail', $user['u_mail']], ['skill', $request['skill']]])->first();
            if($userskill)
            {
                $userskill['score'] = (int)$userskill['score'] + (int) $request['score'];
                $userskill->save();
                return response()->json(['success' => 'score updated'], 401);
            }
            return response()->json(['error' => 'invalid skill'], 401);
        }
        return response()->json(['error' => 'invalid token or expired'], 401);
    }

    public function FollowUser(Request $request){
        $user = User::where('remember_token',$request['Authorization'])->first();
        if($user){
            $validator = Validator::make($request->all(), [ 
                'followeduser' => 'required|email',
            ]);
            if ($validator->fails()) 
            { 
                return response()->json($validator->errors(), 401);            
            }
            $followeduser = FollowUser();
            $followeduser['u_mail'] = $user['u_mail'];
            $followeduser['f_mail'] = $request['followeduser'];
            FollowUser::create($followeduser);
            return response()->json(['success' => 'user added to followers'], 401);
        }
        return response()->json(['error' => 'invalid token or expired'], 401);
    }

    public function FollowCompany(Request $request){
        $user = User::where('remember_token',$request['Authorization'])->first();
        if($user){
            $validator = Validator::make($request->all(), [ 
                'followedcompany' => 'required|email',
            ]);
            if ($validator->fails()) 
            { 
                return response()->json($validator->errors(), 401);            
            }
            $followedcompany = FollowCompany();
            $followedcompany['u_mail'] = $user['u_mail'];
            $followedcompany['c_mail'] = $request['followedcompany'];
            FollowUser::create($followedcompany);
            return response()->json(['success' => 'company added to followers'], 401);
        }
        return response()->json(['error' => 'invalid token or expired'], 401);
    }

    public function AddResolvedQuiz(Request $request){
        $user = User::where('remember_token',$request['Authorization'])->first();
        if($user){
            $validator = Validator::make($request->all(), [ 
                'q_id' => 'required|numeric',
            ]);
            if ($validator->fails()) 
            { 
                return response()->json($validator->errors(), 401);            
            }
            $quiz = Quiz();
            $quiz['u_mail'] = $user['u_mail'];
            $quiz['q_id'] = $request['q_id'];
            Quiz::create($quiz);
            return response()->json(['success' => 'quiz added'], 401);
        }
        return response()->json(['error' => 'invalid token or expired'], 401);
    }

    public function GetFollowedCompanies(Request $request){
        $user = User::where('remember_token',$request['Authorization'])->first();
        if($user){
            $companies = FollowCompany::where('u_mail', $user['u_mail'])-get();
            return response()->json(['companies' => $companies], 200);
        }
        return response()->json(['error' => 'invalid token or expired'], 401);
    }

    public function GetFollowedUsers(Request $request){
        $user = User::where('remember_token',$request['Authorization'])->first();
        if($user){
            $companies = FollowCompany::where('u_mail', $user['u_mail'])-get();
            return response()->json(['companies' => $companies], 200);
        }
        return response()->json(['error' => 'invalid token or expired'], 401);
    }
    
}

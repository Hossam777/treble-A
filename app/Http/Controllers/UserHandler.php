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
        if(Auth::attempt(['u_mail' => $request['mail'], 'password' => request('password')])){ 
            $user = Auth::user();  
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['admin'] = $user->username;
            return response()->json($success, $this-> successStatus); 
        }
        if(Auth::attempt(['username' => $request['mail'], 'password' => request('password')])){ 
            $user = Auth::user();  
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['tokenName'] = $user->username;
            return response()->json($success, $this-> successStatus); 
        }
        $user = User::where('u_mail',$request['mail'])->orWhere('username',$request['mail'])->first();
        if($user)
            return response()->json(['failed'=> ['wrong password']], 401);
        return response()->json(['failed'=> ['wrong mail or password']], 401);
    }

    /*public function Test(){
        $user = Auth::user();
        return response()->json(['success' => $user], 200);
    }*/

    public function UpdateProfile(Request $request){
        $validator = Validator::make($request->all(), [
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
        $user = Auth::user();
        $input = $request->all();
        
        foreach ($input as $key => $value) {
            $user[$key] = $input[$key];
        }
        $user->save();
        return response()->json(['success'=> 'updated successfully'], $this-> successStatus);
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
        $input['password'] = bcrypt($input['password']); 
        try{
        $user = User::create($input);
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json(['failed' => $ex->getMessage()],402);
        }
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['tokenName'] =  $user['username'];
        return response()->json(['success'=>$success], $this-> successStatus);
    }


    public function UserData(Request $request) 
    { 
        $user = Auth::user();
        return response()->json(['success' => $user], 200);
    }

    public function AddSkill(Request $request){
        $user = Auth::user();
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
        try{
            UserSkills::create($userskill);
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json(['failed' => $ex->getMessage()],402);
        }
        return response()->json(['success' => 'skill added'], 401);
    }

    public function UpdateScore(Request $request){
        $user = Auth::user();
            $validator = Validator::make($request->all(), [ 
                'skill' => 'required|string',
                'score' => 'required|numeric' ,
            ]);
            if ($validator->fails()) 
            { 
                return response()->json($validator->errors(), 401);            
            }
            try{
                $userskill = UserSkills::where([['u_mail', $user['u_mail']], ['skill', $request['skill']]])->first();
            }catch(\Illuminate\Database\QueryException $ex){
                return response()->json(['failed' => $ex->getMessage()],402);
            }
            if($userskill)
            {
                $userskill['score'] = (int)$userskill['score'] + (int) $request['score'];
                $userskill->save();
                return response()->json(['success' => 'score updated'], 401);
            }
            return response()->json(['error' => 'invalid skill'], 401);
    }

    public function FollowUser(Request $request){
        $user = Auth::user();
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
            try{
                FollowUser::create($followeduser);
            }catch(\Illuminate\Database\QueryException $ex){
                return response()->json(['failed' => $ex->getMessage()],402);
            }
            return response()->json(['success' => 'user added to followers'], 401);
    }

    public function FollowCompany(Request $request){
        $user = Auth::user();
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
            try{
                FollowUser::create($followedcompany);
            }catch(\Illuminate\Database\QueryException $ex){
                return response()->json(['failed' => $ex->getMessage()],402);
            }
            return response()->json(['success' => 'company added to followers'], 401);
    }

    public function AddResolvedQuiz(Request $request){
        $user = Auth::user();
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
            try{
                Quiz::create($quiz);
            }catch(\Illuminate\Database\QueryException $ex){
                return response()->json(['failed' => $ex->getMessage()],402);
            }
            return response()->json(['success' => 'quiz added'], 401);
    }

    public function GetFollowedCompanies(Request $request){
        $user = Auth::user();
            $companies = FollowCompany::where('u_mail', $user['u_mail'])-get();
            return response()->json(['companies' => $companies], 200);
    }

    public function GetFollowedUsers(Request $request){
        $user = Auth::user();
            $companies = FollowCompany::where('u_mail', $user['u_mail'])-get();
            return response()->json(['companies' => $companies], 200);
    }

}

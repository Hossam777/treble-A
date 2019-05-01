<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\skill as UserSkills;
use App\followed_user as FollowUser;
use App\followed_comany as FollowCompany;
use App\company as Company;
use App\quiz as Quiz; 
use Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserHandler extends Controller
{
    public $successStatus = 200;
    //
    /*public function Test(){
        $user = Auth::user();
        return response()->json(['success' => $user], 200);
    }*/

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
            return response()->json(['failed'=> ['wrong password']], 400);
        return response()->json(['failed'=> ['wrong mail or password']], 400);
    }

    public function Register(Request $request){
        $validator = Validator::make($request->all(), [ 
            'u_mail' => 'required|email|unique:users',
            'username' => 'required|unique:users' ,
            'password' => 'required|min:8', 
            'c_password' => 'required|same:password', 
            'f_name' => 'required',
            'l_name' => 'required',
            'age' => 'required',
            'gender' => 'required',
        ]);
        if ($validator->fails()) 
        { 
            return response()->json($validator->errors(), 400);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return response()->json(['success' => 'Resgistered successfully'], $this-> successStatus); 
    }

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
            return response()->json($validator->errors(), 400);            
        }
        $user = Auth::user();
        $input = $request->all();
        
        foreach ($input as $key => $value) {
            $user[$key] = $input[$key];
        }
        $user->save();
        return response()->json(['success'=> 'updated successfully'], $this-> successStatus);
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
            return response()->json($validator->errors(), 400);            
        }
        $userskill = array();
        $userskill['u_mail'] = $user['u_mail'];
        $userskill['skill'] = $request['skill'];
        $userskill['score'] = '0';
            UserSkills::create($userskill);
        return response()->json(['success' => 'skill added'], 200);
    }

    public function UpdateScore(Request $request){
        $user = Auth::user();
            $validator = Validator::make($request->all(), [ 
                'skill' => 'required|string',
                'score' => 'required|numeric' ,
            ]);
            if ($validator->fails()) 
            { 
                return response()->json($validator->errors(), 400);            
            }
                $userskill = UserSkills::where([['u_mail', $user['u_mail']], ['skill', $request['skill']]])->first();
            if($userskill)
            {
                $userscore = (int)$userskill['score'] + (int) $request['score'];
                UserSkills::where([['u_mail', $user['u_mail']], ['skill', $request['skill']]])->update(['score' => $userscore]);
                return response()->json(['success' => 'score updated'], 200);
            }
            return response()->json(['error' => 'invalid skill'], 404);
    }

    public function FollowUser(Request $request){
        $user = Auth::user();
            $validator = Validator::make($request->all(), [ 
                'followeduser' => 'required|email',
            ]);
            if ($validator->fails()) 
            { 
                return response()->json($validator->errors(), 400);            
            }
            $followeduserfound = User::where(['u_mail' => $request['followeduser']])->first();
            if($followeduserfound == null){
                return response()->json(['failed' => 'followed user not found'], 402);
            }
            $followeduser = array();
            $followeduser['u_mail'] = $user['u_mail'];
            $followeduser['f_mail'] = $request['followeduser'];
                FollowUser::create($followeduser);
            return response()->json(['success' => 'user added to followers'], 200);
    }

    public function FollowCompany(Request $request){
        $user = Auth::user();
            $validator = Validator::make($request->all(), [ 
                'followedcompany' => 'required|email',
            ]);
            if ($validator->fails()) 
            { 
                return response()->json($validator->errors(), 400);            
            }
            $followedcompanyfound = Company::where(['c_mail' => $request['followedcompany']])->first();
            if($followedcompanyfound == null){
                return response()->json(['failed' => 'followed comapny not found'], 402);
            }
            $followedcompany = array();
            $followedcompany['u_mail'] = $user['u_mail'];
            $followedcompany['c_mail'] = $request['followedcompany'];
                FollowUser::create($followedcompany);
            return response()->json(['success' => 'company added to followers'], 200);
    }

    public function AddResolvedQuiz(Request $request){
        $user = Auth::user();
            $validator = Validator::make($request->all(), [ 
                'q_id' => 'required|numeric',
            ]);
            if ($validator->fails()) 
            { 
                return response()->json($validator->errors(), 400);            
            }
            $quiz = array();
            $quiz['u_mail'] = $user['u_mail'];
            $quiz['q_id'] = $request['q_id'];
                Quiz::create($quiz);
            return response()->json(['success' => 'quiz added'], 200);
    }

    public function GetFollowedCompanies(){
        $user = Auth::user();
            $companies = FollowCompany::where('u_mail', $user['u_mail'])->get();
            return response()->json(['companies' => $companies], 200);
    }

    public function GetFollowedUsers(){
        $user = Auth::user();
            $users = FollowUser::select('f_mail')->where('u_mail', $user['u_mail'])->get();
            return response()->json(['users' => $users], 200);
    }

    public function Logout(){
        Auth::logout();        
    }

}

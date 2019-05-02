<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Validator;

class CompanyHandler extends Controller
{
    public $successStatus = 200;

    public function Login(Request $request){
        
        /*if(Auth::guard('company')->attempt(['c_mail' => $request['mail'], 'c_password' => request('password')])){ 
            $company = Auth::guard('company')->user();  
            $success['token'] =  $company->createToken('MyApp')-> accessToken; 
            $success['tokenName'] = $company->c_mail;
            return response()->json($success, $this-> successStatus); 
        }
        $company = company::where('c_mail',$request['mail'])->first();
        if($company)
            return response()->json(['failed'=> ['wrong password']], 400);
        return response()->json(['failed'=> ['wrong mail']], 400);
        */
        $input = $request->all();
        $company = company::where('c_mail', request('mail'))->first();

        if($company == null){
            return response()->json(['email'=> ['wrong mail']], 400);
        }
        else if(!Hash::check(request('password'), $company['c_password']))
        {
            return response()->json(['password'=> ['wrong password']], 401);
        }
        else{
            //$success['token'] =  $company->createToken($company['c_mail'])->accessToken;
            //$success['name'] =  $company['name'];
            return response()->json(['success' => $company], $this->successStatus);
        }
    }


    public function Register(Request $request){
        $validator = Validator::make($request->all(), [ 
            'c_mail'            => 'required|email|unique:companies',
            'name'              => 'required',
            'password'          => 'required|min:8',
            'c_password'        => 'required|same:password',
        ]);

        if($validator->fails()) {
            return response()->json($validator->error(), 402);
        }

        $input = $request->all();
        $input['c_password'] = bcrypt($input['password']);
        $company = company::create($input);
        return response()->json(['success'=>'Registered successfully'], $this->successStatus);
    }
}

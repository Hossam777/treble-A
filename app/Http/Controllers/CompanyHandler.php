<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;

class CompanyHandler extends Controller
{
    public $successStatus = 200;


    public function Login(Request $request){
        $input = $request->all();
        $company_email = $input['mail'];
        $password = $input['password'];
        $company = User::where('c_mail', $company_email)->first();

        if($company == null){
            return response()->json(['email'=> ['wrong mail']], 400);
        }
        else if(!Hash::check($input['password'], $company['password']))
        {
            return response()->json(['password'=> ['wrong password']], 401);
        }
        else{
//            $success['token'] =  $company->createToken($company['c_mail'])->accessToken;
//            $company['remember_token'] = $success['token'];
//            $company->save();
            $success['name'] =  $company['name'];
            return response()->json(['success' => $success], $this->successStatus);
        }
    }


    public function Register(Request $request){
        $validator = Validator::make($request->all(), [ 
            'c_mail'            => 'required|email|unique:companies',
            'name'              => 'required',
            'password'          => 'required|min:8',
            'c_password'        => 'required|same:password',
        ]);

        return response()->json(['success'=>'true'], $this->successStatus);
        if($validator->fails()) {
            return response()->json($validator->error(), 402);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $company = company::create($input);
        $success['token'] =  $company->createToken($company['c_mail'])->accessToken;
        $success['name'] =  $company->name;
        return response()->json(['success'=>$success], $this->successStatus);
    }
}

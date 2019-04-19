<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;

class CompanyHandler extends Controller
{
    public $unauthorizedStatus = 401;
    public $successStatus = 200;


    public function login(Request $request){
        $input = $request->all();
        $company_email = $input['mail'];
        $password = $input['password'];
        $company = User::where('c_mail', $company_email)->first();

        if($company == null){
            return response()->json(['email'=> ['wrong mail']], $this->unauthorizedStatus);
        }
        else if(!Hash::check($input['password'], $company['password']))
        {
            return response()->json(['password'=> ['wrong password']], $this->unauthorizedStatus);
        }
        else{
//            $success['token'] =  $company->createToken($company['c_mail'])->accessToken;
//            $company['remember_token'] = $success['token'];
//            $company->save();
            $success['name'] =  $company['name'];
            return response()->json(['success' => $success], $this->successStatus);
        }
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'c_mail'            => 'required|email',
                'name'              => 'required',
                'password'          => 'required',
                'confirm_password'  => 'required|same:password',
            ]
        );

        if($validator->fails()) {
            return response()->json($validator->error(), $this->unauthorizedStatus);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $company = company::create($input);
//        $success['token'] =  $company->createToken($company['c_mail'])->accessToken;
//        $company['remember_token'] = $success['token'];
//        $company->save();
        $success['name'] =  $company->name;
        return response()->json(['success'=>$success], $this->successStatus);



    }
}

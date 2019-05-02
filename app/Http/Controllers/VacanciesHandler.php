<?php

namespace App\Http\Controllers;

use App\vacancy;
use Illuminate\Http\Request;

class VacanciesHandler extends Controller
{
    //
    public function AddVacancy(Request $request){
        $input = $request->all();
        $company = company::where('c_mail', request('mail'))->first();

        if($company == null){
            return response()->json(['email'=> ['wrong mail']], 400);
        }
        else if(!Hash::check(request('password'), $company['c_password']))
        {
            return response()->json(['password'=> ['wrong password']], 401);
        }

        $validator = Validator::make($request->all(), [ 
            'title' => 'required',
            'description' => 'required',
            'requirments' => 'required',
            'benifits' => 'required',
            'salary' => 'required|int',
            'type' => 'required',
        ]);
        if ($validator->fails()) 
        { 
            return response()->json($validator->errors(), 400);            
        }
        $vacancy = vacancy::create($request);
        if($vacancy)
            return response()->json([['success' => 'Form Added successfully'],['id' => $vacancy['v_id']]], $this-> successStatus);
            
        return response()->json(['failed' => 'Form Added successfully'], $this-> successStatus);
    }

    public function GetVacancyByCompany(Request $request){
        $validator = Validator::make($request->all(), [ 
            'c_mail' => 'required',
        ]);
        if ($validator->fails()) 
        { 
            return response()->json($validator->errors(), 400);            
        }
        $vacancies = CandForm::where('c_mail',$request['c_mail'])->get();
        return response()->json(['success' => $vacancies], $this-> successStatus);
    }

    public function GetALLVacancies(Request $request){
        $vacancies = CandForm::get();
        return response()->json(['success' => $vacancies], $this-> successStatus);
    }
}

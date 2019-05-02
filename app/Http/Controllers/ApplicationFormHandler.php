<?php
use App\application_form as AppForm;
use App\company;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationFormHandler extends Controller
{
    //
    public function AddForm(Request $request){
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
            'v_id' => 'required|exists:vacancies',
            'q' => 'required',
        ]);
        if ($validator->fails()) 
        { 
            return response()->json($validator->errors(), 400);            
        }
        $form = AppForm::create($input);
        return response()->json(['success' => 'Form Added successfully'], $this-> successStatus);
    }

    public function GetForm(Request $request){
        $validator = Validator::make($request->all(), [ 
            'v_id' => 'required|exists:vacancies',
        ]);
        if ($validator->fails()) 
        { 
            return response()->json($validator->errors(), 400);            
        }
        $forms = AppForm::where('v_id', $request['v_id'])->get();
        return response()->json(['success' => $forms], $this-> successStatus);
    }
}

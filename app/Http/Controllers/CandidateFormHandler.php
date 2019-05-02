<?php

namespace App\Http\Controllers;
use App\candidate_form as CandForm;
use Illuminate\Http\Request;

class CandidateFormHandler extends Controller
{
    //
    public function AddForm(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(), [ 
            'v_id' => 'required|exists:vacancies',
            'a' => 'required',
        ]);
        if ($validator->fails()) 
        { 
            return response()->json($validator->errors(), 400);            
        }
        $request['u_mail'] = $user['u_mail'];
        $form = CandForm::create($input);
        return response()->json(['success' => 'Form Added successfully'], $this-> successStatus);
    }

    public function GetForms(Request $request){
        $validator = Validator::make($request->all(), [ 
            'v_id' => 'required|exists:vacancies',
        ]);
        if ($validator->fails()) 
        { 
            return response()->json($validator->errors(), 400);            
        }
        $forms = CandForm::where('v_id', $request['v_id'])->get();
        return response()->json(['success' => $forms], $this-> successStatus);
    }
}

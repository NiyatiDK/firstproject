<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;


class GeneralController extends Controller
{
    //
    public function authentication(Request $request)
    {
        $messages = [
            'uniqueid.required'=> trans('Email is Required'),
            'password.required' => trans('Password is Required'),
        ];

        $validator = Validator::make($request->all(), [
                'uniqueid' => 'required',
                'password' => 'required',
        ], $messages);
       //dd($validator->fails());
        if ($validator->fails()) {
            return view('login')
						->withErrors($validator);
        }
        $patient1=Patient::where('uniqueid',$request->uniqueid)->where('password',$request->password)->get()->first();
        if(!empty($patient1))
        {
           return redirect()->route('patientDashboard');
        }
        else
        {
            return view('login');
        }
    }

}

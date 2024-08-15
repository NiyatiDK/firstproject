<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Patient;



class PatientController extends Controller
{
    //
    public function saveNewPatient(Request $request)
    {
        //dd($request);
        $messages = [
            'First_name.required'=> trans('Patient First Name is Required'),
            'last_name.required'=> trans('Patient Last Name is Required'),
            'email.required'=> trans('Patient Email is Required'),
            'password.required'=> trans('Password is Required'),
            'password.regex' => trans('Password with Minimum eight characters, at least one uppercase letter, one lowercase letter and one number'),
            'contact.required' => trans('Contact is Required'),
            'contact.regex' => trans('10 Digit Contact Number'),
            'dob.required' => trans('Birth Date is Required'),
            'address.required' => trans('Address is Required')
        ];

        $validator = Validator::make($request->all(), [
                'First_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',
                'contact' => 'required|regex:/^\d{10}$/',
                'dob' => 'required',
                'address' => 'required',
                
        ], $messages);
       
        if ($validator->fails()) {
            return redirect()->back()
						->withErrors($validator)
						->withInput();
        }

        $patient = new Patient();
        $patient->fname = $request->First_name;
        $patient->lname = $request->last_name;
        $patient->email = $request->email;
        $patient->password = $request->password;
        $patient->contact = $request->contact;
        $patient->gender = $request->gender;
        $patient->dob = $request->dob;
        $patient->address = $request->address;
        $str= 'p'. $request->contact . $request->First_name;
        $patient->uniqueid = $str;
        
        try {
           $patient->save();
           
           return redirect()->route('welcome')->withSuccessMessage(trans('Patient Added Successfully. and your Unique Id is:  '. $str));

           
        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->withErrors(['error' => $qe->getMessage()]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        } catch (\Throwable $th) {
            //dd($th);
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    

}

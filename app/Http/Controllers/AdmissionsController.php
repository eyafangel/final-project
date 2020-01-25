<?php

namespace App\Http\Controllers;

use App\Guardian;
use App\Patient;
use App\Residence;
use App\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdmissionsController extends Controller
{
    
    public function home()
    {
        return view('admissions.home');
    }
    public function patientlist()
    {
        $patients = Patient::all();
 
        return view('admissions.list',compact('patients'));
    }
    public function create()
    {
        return view('admissions.create_patient');
    }

    public function store()
    {
        $patient = new Patient();
        $residence = new Residence();
        $guardian = new Guardian();
        $admission = new Admission();

        $id = Auth::id();

        $admission->room = request('room');
        $admission->category = request('category');
        $admission->status = request('status');
        $admission->admission_date = request('admission_date');
        $admission->users_id = $id;
 
        $patient->last_name = request('last_name');
        $patient->first_name = request('first_name');
        $patient->middle_name = request('middle_name');
        $patient->sex = request('sex');
        $patient->birthday = date('Y-m-d', strtotime($patient['birthday']));        
        $patient->age = request('age');
        $patient->contact_number = request('contact_number');
        $patient->marital_status = request('marital_status');
        $patient->nationality = request('nationality');
                
        $residence->lot=request('lot');
        $residence->street=request('street');        
        $residence->city=request('city');
        $residence->postal_code=request('postal_code');
        $residence->province=request('province');
        $residence->country=request('country');

        // $patient->residence()->associate($residence);
        // $patient->guardian()->associate($guardian);        
                
        $guardian->guardian_last_name=request('guardian_last_name');
        $guardian->guardian_first_name=request('guardian_first_name');
        $guardian->guardian_middle_name=request('guardian_middle_name');
        $guardian->guardian_contact_number=request('guardian_contact_number');
        $guardian->relationship_to_patient=request('relationship_to_patient');
        
        $admission->save();
        $residence->save();
        $patient->save();
        $guardian->save();

        // Session::flash('alert-success', 'User was successful added!');
        return redirect('admissions')->with('message','Success');
    }

    // public function profile(){
    //     $user = Patient::where('username', '=' , $user);

    // if($user->count()) {
    //     $user = $user->first();

    //     return View::make('profile.user')
    //         ->with('user', $user);
    // }

    // return App::abort(404);
    // }
    // }
    
}

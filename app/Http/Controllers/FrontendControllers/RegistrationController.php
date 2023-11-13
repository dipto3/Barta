<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegistrationFormRequest;

class RegistrationController extends Controller
{
    public function create(){

        return view('frontend.auth.registration');
    }

    public function store(RegistrationFormRequest $request){

        $request->validated();
        $input = DB::table('users')->insert([
            'name' => $request->name,
            'email'=>$request->email,
            'userName'=>$request->userName,
            'password'=>Hash::make($request->password)
        ]);

        if($input){
            return back()->with('success','Registration Successful!');
        }else{
            return back()->with('fail','Something went wrong!!');
        }
    }
}

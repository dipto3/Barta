<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function create(){

        return view('frontend.auth.registration');
    }

    public function store(Request $request){

        $input = DB::table('users')->insert([
            'name' => $request->name,
            'email'=>$request->email,
            'userName'=>$request->username,
            'password'=>Hash::make($request->password)
        ]);

        if($input){
            return back()->with('success','Registration Successful');
        }else{
            return back()->with('Something went wrong!!');
        }
    }
}

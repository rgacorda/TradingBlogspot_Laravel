<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use DB;

class CustomAuthController extends Controller
{
    public function registerUser(Request $request){
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name=$request->last_name;
        $user->middle_name=$request->middle_name;
        $user->email=$request->email;
        $user->role_id=2;
        $user->bio='empty';
        $user->password=Hash::make($request->password);
        $res = $user->save(); 
        if($res){
            return back()->with('success','You have registered Succesfully');
        }else{
            return back()->with('fail','Something wrong');
        }
        //convert confirmation to footer modal
    }


    
    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password' => 'required|min:8'
        ]);

        $user = User::where('email','=',$request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                $request->session()->put('loginID',$user->id);
                $request->session()->put('roleID',$user->role_id);

                return redirect('dashboard');
            }else{
                return back()->with('fail','Password Incorrect');
            }
        }else{
            return back()->with('fail','Email is not Registered');
        }
        //convert confirmation to footer modal
    }

    public function dashboard(Request $request){
        if(Session::has('loginID')){
            return view('welcome');
        }else{
            return redirect('logout');
        }
    }
    public function logout(){

        if(Session::has('loginID')){
            Session::pull('loginID');
            return view('welcome');
        }
        
    }
}

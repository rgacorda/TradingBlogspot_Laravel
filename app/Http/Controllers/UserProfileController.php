<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use DB;
use Session;
use Hash;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //for admin registration
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
            'role_id'=>'required'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name=$request->last_name;
        $user->middle_name=$request->middle_name;
        $user->email=$request->email;
        $user->role_id=$request->role_id;
        $user->bio='empty';
        $user->password=Hash::make($request->password);
        $res = $user->save(); 
        if($res){
            return back()->with('success','You have registered Succesfully');
        }else{
            return back()->with('fail','Something wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
         $userdetails = DB::table('users')
         ->join('roles','users.role_id','=','roles.id')
         ->where('users.id','=',$user->id)
         ->first();


        $userposts = Post::where('user_id',$user->id)->get();
        $users = DB::table('users')
                      ->join('roles','users.role_id','=','roles.id')
                      ->get();
        $posts = DB::table('users')
                      ->join('posts','users.id','=','posts.user_id')
                      ->select('posts.title','users.first_name','users.middle_name','users.last_name')
                      ->get();
        
        $cats = DB::table('cats')->get();
        $roles = DB::table('roles')->get();
              

        return view('user_func.edit_user_profile', compact('userdetails','userposts','users','posts','cats','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //add validations & modal alert footer

        $users = DB::table('users')
        ->where('id','=' ,$user->id)
        ->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'bio' => $request->bio,
            'password' => Hash::make($request->password)
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

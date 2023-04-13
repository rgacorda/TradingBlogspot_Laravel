<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Cat;
use Illuminate\Http\Request;
use DB;

class PostController extends Controller
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
        //add photos
        $request->validate([
            'title'=>'required',
            'content' => 'required',
            'cats' => 'required'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $request->session()->get('loginID');
        $post->cat_id = $request->cats;
        $res = $post->save();

        if($res){
            return back()->with('success','You have stored Succesfully');
        }else{
            return back()->with('fail','Something wrong');
        }
        //convert confirmation to footer modal
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //add photos
        $showpost = Post::where('id',$post->id)->first();
        $author = User::where('id',$showpost->user_id)->first();
        $category = Cat::where('id',$showpost->cat_id)->first();
        $comments = DB::table('comms')
                ->join('posts','comms.post_id','=','posts.id')
                ->join('users','comms.user_id','=','users.id')
                ->select('comms.content','users.first_name','users.middle_name','users.last_name','comms.user_id','comms.id')
                ->get();

        return view('user_func.show_postcom', compact('showpost','author','category','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

    }
    public function updatePost(Request $request){
        //add photos

        $request->validate([
            'title'=>'required',
            'content' => 'required',
            'cats' => 'required'
        ]);
        
        $users = DB::table('posts')
        ->where('id','=' ,$request->id)
        ->update([
            'title' => $request->title,
            'content' => $request->content,
            'cat_id' => $request->cats
        ]);
        return back()->with('success', 'Post has been updated successfully');
    }

    public function deletePost(Request $request){
        $deleted = Post::find($request->post_id);
        $deleted->delete();

        return back()->with('success', 'Post has been deleted successfully');
    }
}

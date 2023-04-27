<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Cat;
use Illuminate\Http\Request;
use DB;
use File;

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

        if($request->hasFile('image')){
            if($request->hasFile('image')){
                $extension = $request->file('image')->extension();
                $destination_path = 'public/images/posts';
                $image = $request->file('image');
                $image_name = 'post_'.session()->get('loginID').$request->title.'.'.$extension;
                $path = $request->file('image')->storeAs($destination_path,$image_name);

                $input['image'] = $image_name;
            }

            $post->image = $input['image'];
        }

        $res = $post->save();

        if($res){
            return back()->with('success','You have stored Succesfully');
        }else{
            return back()->with('fail','Something wrong');
        }

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
                ->where('posts.id','=',$post->id)
                ->select('comms.content','users.first_name','users.middle_name','users.last_name','comms.user_id','comms.id','comms.rating')
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

        $post = Post::find($request->id);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->cat_id = $request->cats;

        if($request->hasFile('image')){
            $destination = 'storage/images/posts'.$post->image;
            if(File::exists($destination)){
                File::delete($destination);
            }

            if($request->hasFile('image')){
                $extension = $request->file('image')->extension();
                $destination_path = 'public/images/posts';
                $image = $request->file('image');
                $image_name = 'post_'.session()->get('loginID').$request->title.'.'.$extension;
                $path = $request->file('image')->storeAs($destination_path,$image_name);
                $input['image'] = $image_name;
            }

            $post->image = $input['image'];
        }
        $post->save();

        return back()->with('success', 'Post has been updated successfully');
    }

    public function deletePost(Request $request){
        $deleted = Post::find($request->post_id);
        $deleted->delete();

        return back()->with('success', 'Post has been deleted successfully');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search by user name (only show title and content)
        $user_posts = Post::select('posts.title', 'posts.content', 'users.first_name', 'users.middle_name', 'users.last_name', 'posts.id')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->where(function ($q) use ($query) {
                $q->where('users.first_name', 'LIKE', '%' . $query . '%')
                    ->orWhere('users.middle_name', 'LIKE', '%' . $query . '%')
                    ->orWhere('users.last_name', 'LIKE', '%' . $query . '%');
            })
            ->get();

        // Search by post title (show titles)
        $title_posts = Post::select('title', 'content', 'id')
            ->where('title', 'LIKE', '%' . $query . '%')
            ->get();

        // Search by content title(show contents and titles)
        $content_posts = Post::select('title', 'content', 'id')
            ->where('content', 'LIKE', '%' . $query . '%')
            ->get();

        return view('search_func.posts_search', compact('user_posts', 'title_posts', 'content_posts', 'query'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Cat;
use Illuminate\Http\Request;
use DB;
use File;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

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
        
        $adminchecker = DB::table('users')
                        ->join('roles','users.role_id','=','roles.id')
                        ->where('roles.role_desc','=','admin')
                        ->where('users.id','=',$request->session()->get('loginID'))
                        ->first();

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        

        if($adminchecker){
            $post->isApproved = "Accepted";
            $post->isDelete = "No Request";
        }else{
            $post->isApproved = "To be Approved";
            $post->isDelete = "No Request";
        }

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
            'content' => 'required'
        ]);

        $post = Post::find($request->id);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->isApproved = "To be Approved";
        $post->isDelete = "No Request";
        $post->reason = null;
        if(!empty($request->cats)){
            $post->cat_id = $request->cats;
        }

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

    public function deletePrompt(Request $request){
        $request->validate([
            'deletereason'=>'required'
        ]);

        $adminchecker = DB::table('users')
                        ->join('roles','users.role_id','=','roles.id')
                        ->where('roles.role_desc','=','admin')
                        ->where('users.id','=',$request->session()->get('loginID'))
                        ->first();
        
        $deleted = Post::find($request->post_id);
        if($adminchecker){
            $deleted->delete();
            
            return back()->with('success', 'Post has been deleted successfully');
        }else{
            $deleted->DeleteReason = $request->deletereason;
            $deleted->isDelete = "To be Approved";
            $deleted->save();
            
            return back()->with('success', 'Post delete is successfully requested');
        }

        

    }

    public function deleteReject(Request $request){
        $request->validate([
            'reason'=>'required'
        ]);

        $deleted = Post::find($request->post_id);
        $deleted->isDelete = "Rejected";
        $deleted->reason = $request->reason;
        $deleted->save();

        return back()->with('success', 'Delete Post has been rejected successfully');
    }



    public function search(Request $request)
{
    $request->validate([
        'query'=>'required'
    ]);
    $query = $request->input('query');

    // Search by user name (only show title and content)
    $user_posts = Post::select('posts.title', 'posts.content', 'users.first_name', 'users.middle_name', 'users.last_name', 'posts.id')
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->where(function ($q) use ($query) {
            $q->where('users.first_name', 'LIKE', '%' . $query . '%')
                ->orWhere('users.middle_name', 'LIKE', '%' . $query . '%')
                ->orWhere('users.last_name', 'LIKE', '%' . $query . '%');
        })
        ->where('isApproved','=','Accepted')
        ->paginate(3);

    // Search by post title (show titles)
    $title_posts = Post::select('title', 'content', 'id')
        ->where('title', 'LIKE', '%' . $query . '%')
        ->where('isApproved','=','Accepted')
        ->paginate(3);

    // Search by content title(show contents and titles)
    $content_posts = Post::select('title', 'content', 'id')
        ->where('content', 'LIKE', '%' . $query . '%')
        ->where('isApproved','=','Accepted')
        ->paginate(3);

    // Search by category description (show titles, content, and category)
    $category_posts = Post::select('posts.title', 'posts.content', 'cats.cat_desc', 'posts.cat_id', 'posts.id')
        ->join('cats', 'cats.id', '=', 'posts.cat_id')
        ->where('cats.cat_desc', 'LIKE', '%' . $query . '%')
        ->where('isApproved','=','Accepted')
        ->paginate(3);

    return view('search_func.posts_search', compact('user_posts', 'title_posts', 'content_posts', 'category_posts', 'query'));
}

    public function approvePost(Request $request){
        $post = Post::find($request->post_id);
        $post->isApproved = "Accepted";
        $post->reason = null;
        $post->save();

        return back()->with('success','The post has been Accepted');
    }
    public function rejectPost(Request $request){
        $request->validate([
            'reason'=>'required'
        ]);

        $post = Post::find($request->post_id);
        $post->isApproved = "Rejected";
        $post->reason = $request->reason;
        $post->save();

        return back()->with('success','The post has been Rejected');
    }

    public function generatePDF(Request $request)
    {
        $month = $request->input('month') ?? Carbon::now()->month;

        // Get all posts with user and category information for selected month
        $posts = DB::table('users')
        ->join('posts', 'users.id', '=', 'posts.user_id')
        ->join('cats', 'cats.id', '=', 'posts.cat_id')
        ->select('posts.title', 'users.first_name', 'users.middle_name', 'users.last_name', 'posts.id', 'posts.user_id', 'posts.cat_id', 'cats.cat_desc', 'posts.isApproved', 'posts.created_at', 'posts.updated_at')
        ->whereMonth('posts.created_at', '=', $month)
            ->get();

        $pdf = PDF::loadView('reports_func.generate_reports', [
            'posts' => $posts,
        ]);

        return $pdf->stream();
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function Home(){
        $posts = DB::table('users')
                    ->join('posts','users.id','=','posts.user_id')
                    ->select('posts.title','users.first_name','users.middle_name','users.last_name','posts.id')
                    ->get();
        return view('welcome', compact('posts'));
    }
    public function LongTerm(){
        $posts = DB::table('posts')
                    ->join('users','users.id','=','posts.user_id')
                    ->where('posts.cat_id','=',1)
                    ->select('posts.title','users.first_name','users.middle_name','users.last_name','posts.id')
                    ->get();
        return view('welcome', compact('posts'));
    }
    public function ShortTerm(){
        $posts = DB::table('posts')
                    ->join('users','users.id','=','posts.user_id')
                    ->where('posts.cat_id','=',2)
                    ->select('posts.title','users.first_name','users.middle_name','users.last_name','posts.id')
                    ->get();
        return view('welcome', compact('posts'));
    }
    public function Intraday(){
        $posts = DB::table('posts')
                    ->join('users','users.id','=','posts.user_id')
                    ->where('posts.cat_id','=',3)
                    ->select('posts.title','users.first_name','users.middle_name','users.last_name','posts.id')
                    ->get();
        return view('welcome', compact('posts'));
    }
    public function LongIdeas(){
        $posts = DB::table('posts')
                    ->join('users','users.id','=','posts.user_id')
                    ->where('posts.cat_id','=',4)
                    ->select('posts.title','users.first_name','users.middle_name','users.last_name','posts.id')
                    ->get();
        return view('welcome', compact('posts'));
    }
    public function ShortIdeas(){
        $posts = DB::table('posts')
                    ->join('users','users.id','=','posts.user_id')
                    ->where('posts.cat_id','=',5)
                    ->select('posts.title','users.first_name','users.middle_name','users.last_name','posts.id')
                    ->get();
        return view('welcome', compact('posts'));
    }
    public function Risk(){
        $posts = DB::table('posts')
                    ->join('users','users.id','=','posts.user_id')
                    ->where('posts.cat_id','=',6)
                    ->select('posts.title','users.first_name','users.middle_name','users.last_name','posts.id')
                    ->get();
        return view('welcome', compact('posts'));
    }
    public function Tips(){
        $posts = DB::table('posts')
                    ->join('users','users.id','=','posts.user_id')
                    ->where('posts.cat_id','=',7)
                    ->select('posts.title','users.first_name','users.middle_name','users.last_name','posts.id')
                    ->get();
        return view('welcome', compact('posts'));
    }
    public function Psychology(){
        $posts = DB::table('posts')
                    ->join('users','users.id','=','posts.user_id')
                    ->where('posts.cat_id','=',8)
                    ->select('posts.title','users.first_name','users.middle_name','users.last_name','posts.id')
                    ->get();
        return view('welcome', compact('posts'));
    }
    public function Secrets(){
        $posts = DB::table('posts')
                    ->join('users','users.id','=','posts.user_id')
                    ->where('posts.cat_id','=',9)
                    ->select('posts.title','users.first_name','users.middle_name','users.last_name','posts.id')
                    ->get();
        return view('welcome', compact('posts'));
    }
    
}

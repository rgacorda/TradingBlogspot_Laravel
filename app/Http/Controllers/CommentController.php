<?php

namespace App\Http\Controllers;

use App\Models\Comm;
use Illuminate\Http\Request;
use Session;
use DB;

class CommentController extends Controller
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
        $request->validate([
            'content'=>'required'
        ]);

        $comm = new Comm();
        $comm->content = $request->content;
        $comm->post_id = $request->post_id;
        $comm->user_id = Session::get('loginID');
        $res = $comm->save();

        if($res){
            return back()->with('success','Comment Posted');
        }else{
            return back()->with('fail','Comment not Posted');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comm  $comm
     * @return \Illuminate\Http\Response
     */
    public function show(Comm $comm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comm  $comm
     * @return \Illuminate\Http\Response
     */
    public function edit(Comm $comm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comm  $comm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comm $comm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comm  $comm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comm $comm)
    {
        //
    }

    public function updateComm(Request $request){
        $request->validate([
            'content' => 'required'
        ]);
        
        $users = DB::table('comms')
        ->where('id','=' ,$request->comm_id)
        ->update([
            'content' => $request->content
        ]);
        return back()->with('success', 'Comment has been updated successfully');
    }

    public function deleteComm(Request $request){
        $deleted = Comm::find($request->comm_id);
        $deleted->delete();

        return back()->with('success', 'Comment has been deleted successfully');
    }
}

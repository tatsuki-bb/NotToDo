<?php

namespace App\Http\Controllers;

use App\Models\Mainlist;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\PostRequest;
use App\Models\Following;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        
        $all_users = $user->getAllUsers(auth()->user()->id);
    
        

        return view('users',[
            'all_users' =>$all_users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PostRequest $request)
    {
         $follow= new Following();

         $follow->user_id = $request->user_id;
         $follow->follow_id = $request->follow_id;

         dd($follow);
        
         $follow->save();

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $follow = new Following();

        $follow->user_id = $request->user_id;
        $follow->follow_id =$request->follow_id;

        // dd($follow);
        
        $follow->save();

        $following = User::find($request->user_id)->name;


        return back()->with('following',"「${following}」さんをフォローしました");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
       
        return view('show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $follow = Following::find($id);
        // dd($follow);
        // $unfollow = $follow->name;

        $follow->delete();

        return back();
        // ->with('unfollow',"「${unfollow}」さんをフォロワー解除しました");
    }

    public function unfollow($id)
    {
        // $deleteId = Following::where('follow_id',$id)->pluck('followings.id');
        // $deleteId->where('follow_id',$id)->pluck('followings.id');
        // $deleteId->where('user_id',Auth::id())->pluck('followings.id');

        $post = Following::query();
        $post->where('follow_id',$id);
        $post->where('user_id',Auth::id());
        $unfollowId = $post->pluck('followings.id')->toArray();

        // $unfollow = Following::find($id);

        Following::where('id',$unfollowId['0'])->delete();

        $unfollowing = User::find($id)->name;

        return back()->with('unfollowing',"「${unfollowing}」さんのフォローを解除しました");
    }

   
   
}

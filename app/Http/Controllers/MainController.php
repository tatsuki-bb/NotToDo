<?php

namespace App\Http\Controllers;

use App\Models\Mainlist;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Models\Following;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function showList() {
        return view('timeline');
    }

    public function edit($id) {

        $mainlists = MainList::find($id);
        $mainlists->load('user'); 

        return view('edit',[
            'mainlists' => $mainlists,
        ]);
    }

    public function myList($id) {

        $user = User::find($id);
        $user->load("mainLists");

        return view('mylist', [
            
            'user' =>$user,
        ]);
    }

    public function searchUser()
    {
        return view('searchUser');
    }

    public function searching(SearchRequest $request)
    {
        
        $searchUser = User::query();
        $searchUser->where('name',$request->search);

        $searchedUsers = $searchUser->get();


        return view('/searchuser',[
            'searchedUsers' => $searchedUsers 
        ]);
    }  


    public function searchUnfollow($id)
    {
        $searchUser = User::query();
        $searchUser->where('id',$id);
        $searchedUsers = $searchUser->get();

        $post = Following::query();
        $post->where('follow_id',$id);
        $post->where('user_id',Auth::id());
        $unfollowId = $post->pluck('followings.id')->toArray();


        Following::where('id',$unfollowId['0'])->delete();

        $searchUnfollowing = User::find($id)->name;

        return view('searchUser',[
            'searchedUsers' => $searchedUsers
        ]);

        // return redirect('/searchuser')->with('$searchUnfollowing',"「${searchUnfollowing}」さんのフォローを解除しました");
    }

    public function searchFollow(Request $request)
    {
        $searchUser = User::query();
        $searchUser->where('id',$request->follow_id);
        $searchedUsers = $searchUser->get();
        
        $follow = new Following();
        $follow->user_id = $request->user_id;
        $follow->follow_id =$request->follow_id;

        // dd($follow);
        
        $follow->save();

        $searchFollowing = User::find($request->user_id)->name;

        // $request->session()->flash('searchFollowing',"「${searchFollowing}」さんをフォローしました");



        return view('searchUser',[
            'searchedUsers' => $searchedUsers
        ]);
        // ->with('searchFollowing',"「${searchFollowing}」さんをフォローしました");
    }

}


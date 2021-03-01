<?php

namespace App\Http\Controllers;


use App\Models\Mainlist;
use App\Models\User;
use App\Models\Post;
use App\Models\Following;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\MessageRequest;
use App\Models\CheckMessage;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Prophecy\Argument\Token\InArrayToken;

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

    public function messageBox($id)
    {
        // $user = User::find($id);
        // $user->load("getmessages");
        
        
        
        $i = Message::where('get_id',$id)->orderBy('id','DESC')->get();
        $s = array();
        $h = array();
        foreach($i as $n) {
            if (!in_array($n->chat_id,$h)) {
                array_push($s,$n);
                array_push($h,$n->chat_id);
            }
        }

        

        // dd($s);

        $get_messages = Message::where('get_id',$id)->get()->sortBy('mainlist_id');
        $get_messages->load("mainlists");
        // dd($get_messages);

        $users = User::get();
        // dd($users);
        $mainlists = Mainlist::get();
        

       return view('messagebox',[
            // 'user' => $user,
            'users' => $users,
            'get_messages' => $get_messages,
            'mainlists' => $mainlists,
            's' => $s
       ]);
    }

    public function chat($id)
    {
        $chats  = Message::where('chat_id',$id)->get();

        $my_chat = Message::where('chat_id',$id)->where('get_id',Auth::id())->first();

        $get_message = Message::where('chat_id',$id)->where('get_id',Auth::id())->get();

        
        $check_message = CheckMessage::get('message_id');
        $check_id = array();
        foreach($check_message as $check_m) {
            array_push($check_id,$check_m->message_id);
        }
        // dd($check_id);

        foreach($get_message as $message) {
            if(!in_array($message->id,$check_id)) {
                $check = new CheckMessage();
                $check->user_id = Auth::id();
                $check->message_id = $message->id;
                $check->check = 1;
                $check->save();
            }
            
        }

        foreach($get_message as $message) {
            if($message->check == 0) {
                $message->check = 1;
                $message->save();
            }
            
        }
        
        
        
        // dd($get_message);
        $content = Mainlist::find($my_chat->mainlist_id);

        $send_user = User::find($my_chat->send_id);

        // dd($send_user);
        return view('chat',[
            'chats' => $chats,
            'my_chat' => $my_chat,
            'send_user' => $send_user,
            'content' => $content
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

    public function sendMessage(MessageRequest $request)
    {
        $message = new Message();

        $message->send_id = $request->sendId;
        $message->get_id = $request->getId;
        $message->mainlist_id = $request->mainlistsId;
        $message->message = $request->message;
        $message->check = 0;
        
        $max_id = Message::max('chat_id');
        $already_id = Message::where('send_id',$request->sendId)->where('mainlist_id',$request->mainlistsId)->get('chat_id');
        // dd($already_id);
        
        if ($already_id == null) {
            $message->chat_id = $max_id + 1;    
        }else {
            $message->chat_id = $already_id;
        }

        
        $message->chat_id = $max_id + 1;

        
        // dd($message);

        $message->save();  
        
        return redirect(route('post.show',$request->mainlistsId))->with('sendMessage',"メッセージを送信しました！");
    }

    public function reply(MessageRequest $request)
    {
        $message = new Message();

        $message->send_id = $request->sendId;
        $message->get_id = $request->getId;
        $message->mainlist_id = $request->mainlistsId;
        $message->message = $request->message;
        $message->chat_id = $request->chatId;
        $message->check = 0;
        
        // dd($message);

        $message->save();  
        
        return back();
    }

    public function deleteMessage() 
    {

    }

}


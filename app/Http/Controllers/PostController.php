<?php

namespace App\Http\Controllers;

use App\Models\MainList;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $mainlists = MainList::orderBy('updated_at','desc')->get();
        $mainlists->load('user');

        // Profile::orderBy('ranked_at', 'desc')
        // ->orderBy('rank', 'asc')
        // ->get();


        $listPaginate = new LengthAwarePaginator(
            $mainlists->forPage($request->page, 5), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
            $mainlists->count(), // 総件数
            5,
            null, // 現在のページ(ページャーの色がActiveになる)
            ['path' => $request->url()] // ページャーのリンクをOptionのpathで指定
        );
    
    
        
        return view('timeline', [
            'mainlists' => $listPaginate ,
        ]);
    }

  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $mainlists = new MainList();

        $mainlists->content = $request->content;
        $mainlists->solution = $request->solution;
        $mainlists->user_id = $request->user_id;
        $mainlists->save();

        $message = $mainlists->content;

    // $input = $request->only($mainlists->getFillable());
    // $post = $mainlists->create($input);

        return redirect(route('myList',Auth::id()))->with('registration',"「${message}」を登録しました");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $mainlists = MainList::find($id);
        $mainlists->load('user'); 

        return view('detail',[
            'mainlists' => $mainlists,
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
    public function update(PostRequest $request, $id)
    {
        
        $mainlists = MainList::find($id); 

        $mainlists->content = $request->content;
        $mainlists->solution = $request->solution;
        
        $mainlists->save();

        $message = $mainlists->content;

        return redirect(route('post.show',$mainlists->id))->with('message',"「${message}」を更新しました");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mainlists = MainList::find($id);

        $message = $mainlists->content;

        $mainlists->delete();

        return redirect(route('myList',Auth::id()))->with('message',"「${message}」を削除しました");
    }

}

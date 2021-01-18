<?php

namespace App\Http\Controllers;

use App\Models\MainList;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $mainlists = MainList::all();
        $mainlists->load('user');

        $listPaginate = new LengthAwarePaginator(
            $mainlists->forPage($request->page, 10), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
            $mainlists->count(), // 総件数
            10,
            null, // 現在のページ(ページャーの色がActiveになる)
            ['path' => $request->url()] // ページャーのリンクをOptionのpathで指定
        );
    
    
        
        return view('NotToDo', [
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
    $post = new MainList();
    // $post->content = $request->content;
    // $post->solution = $request->solution;
    // $post->user_id = $request->user_id;
    // $post->save;

    $input = $request->only($post->getFillable());
    $post = $post->create($input);

        return redirect("/post");
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
        //
    }
}

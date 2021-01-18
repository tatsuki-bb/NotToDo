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
            $mainlists->forPage($request->page, 5), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
            $mainlists->count(), // 総件数
            5,
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
        $mainlists = new MainList();

        $mainlists->content = $request->content;
        $mainlists->solution = $request->solution;
        $mainlists->user_id = $request->user_id;

        $mainlists->save();

    // $input = $request->only($mainlists->getFillable());
    // $post = $mainlists->create($input);

        return redirect(route('posts,index'));
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

        return redirect(route('post.show',$mainlists->id));
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

        $mainlists->delete();

        return redirect(route('posts,index'));
    }
}

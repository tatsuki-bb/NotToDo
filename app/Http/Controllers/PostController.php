<?php

namespace App\Http\Controllers;

use App\Models\MainList;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $posts->load('category');
        $posts->load('user');

        $mainlists = MainList::all();
        $mainlists->load('user');

        
        return view('NotToDo', [
            'posts' => $posts,
            'mainlists' =>$mainlists,
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
    public function store(Request $request)
    {

        $this->validate($request,[
            'content' => 'required',
            'solution' => 'required|max:255',
            'user_id' => 'required|numeric',
        ], [
            'content.required' => ':attributeを入力してください',
            'solution.required' => ':attributeを入力してください',
            'user_id.required' => ':attributeを入力してください',
            'solution.max' => ':attributeの文字数は255文字までです',
            'user_id.numeric' => ':attributeは数字のみ適用されます',
        ]
            
    
    );

    $post = new MainList();
    $post->content = $request->content;
    $post->solution = $request->solution;
    $post->user_id = $request->user_id;
    $post->save;

        return redirect("/post");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MainList $post)
    {
        dd($post);
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

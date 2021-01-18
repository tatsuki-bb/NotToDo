<?php

namespace App\Http\Controllers;

use App\Models\Mainlist;
use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showList() {
        return view('NotToDo');
    }

    public function edit($id) {

        $mainlists = MainList::find($id);
        $mainlists->load('user'); 

        return view('edit',[
            'mainlists' => $mainlists,
        ]);
    }
}
 
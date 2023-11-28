<?php

namespace App\Http\Controllers;

use App\Models\Post;



class BackendController extends Controller
{
    public function admin()
    {
        $posts = Post::latest()->paginate(10);
        $sl = !is_null(\request()->page) ? (\request()->page - 1) * 10 : 0;
        return view('backend.admin');
    }
}

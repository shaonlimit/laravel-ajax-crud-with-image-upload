<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        $sl = !is_null(\request()->page) ? (\request()->page - 1) * 10 : 0;
        return view('backend.admin', compact('posts', 'sl'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->all();
        // dd($data);
        $imageName = '';
        if ($image = $request->file('image')) {
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('images/posts', $imageName);
        }
        $data['image'] = $imageName;
        $data['slug'] = Str::slug($request->title);
        Post::create($data);
        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        Post::find($request->id);
        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->except('_token');



        $post =  Post::where('id', $request->id)->first();
        if ($request->hasFile('image')) {
            $deleteOldImage = 'images/posts/' . $post->image;
            File::delete($deleteOldImage);

            $image = $request->file('image');
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('images/posts', $imageName);

            $data['image'] = $imageName;
        } else {
            $data['image'] = $post->image;
        }

        $data['slug'] = Str::slug($request->title);
        $post->update($data);
        return response()->json([
            'status' => 'success',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $post = Post::where('id', $request->id)->first();
        $post->delete();
        $deleteOldImage = 'images/posts/' . $post->image;
        File::delete($deleteOldImage);
        return response()->json([
            'status' => 'success',
        ]);
    }
    public function pagination(Request $request)
    {
        $posts = Post::latest()->paginate(10);
        $sl = !is_null(\request()->page) ? (\request()->page - 1) * 10 : 0;
        return view('backend.posts.post_pagination', compact('posts', 'sl'))->render();
    }

    public function search(Request $request)
    {
        $posts = Post::where('title', 'like', '%' . $request->search_string . '%')
            ->orWhere('description', 'like', '%' . $request->search_string . '%')
            ->orderBy('id', 'desc')->paginate(10);
        if ($posts->count() >= 1) {
            $sl = !is_null(\request()->page) ? (\request()->page - 1) * 10 : 0;
            return view('backend.posts.post_search', compact('posts', 'sl'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(Request $request){

        $Validated = $request->validate([
            'postId' => 'integer'
        ]);

        $Posts = Post::orderBy('created_at', 'DESC')->get();
        $SelectedPost = null;
        if (array_key_exists('postId', $Validated)){
            $SearchedPostId = $Validated['postId'];
            $SelectedPost = $Posts->first(function($item) use ($SearchedPostId) {
                return $item->id == $SearchedPostId;
            });
        }
        return inertia::render('Blog/Show/BlogShowContainer', ['posts' => $Posts,'selectedPost'=> $SelectedPost]);
    }
    public function create(){
        return inertia::render('Blog/Create/BlogCreateContainer');
    }
    public function edit(Request $request){
        $validated = $request->validate([
            'postId' => 'required',
        ]);
        $Post = Post::where('id', $validated['postId'])->first();
        return inertia::render('Blog/Edit/BlogEditContainer',['post' => $Post]);
    }
}

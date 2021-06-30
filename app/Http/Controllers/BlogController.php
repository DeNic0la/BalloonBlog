<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(){

        $Posts = Post::orderBy('created_at', 'DESC')->get();
        return inertia::render('Blog/Show/BlogShowContainer', ['posts' => $Posts]);
    }
    public function create(){
        return inertia::render('Blog/Create/BlogCreateContainer');
    }
}

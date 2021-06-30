<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function add(Request $request){
        $validated = $request->validate([
            'header' => 'required',
            'subHeader' => 'required',
            'mainText' => 'required',
        ]);
        $Post = Auth::user()->posts()->create([
            'header' => $validated['header'],
            'subHeader' => $validated['subHeader'],
            'mainText' => $validated['mainText'],
        ]);

        return response($Post,201);
    }

    public function uploadImage(Request $request, $postId){

        $validated = $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png',
        ]);


        $random = Str::random(40);
        $file_name = time().'_'.$random;//$request->file->getClientOriginalName();
        $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

        $Post = Post::where('id',$postId)->first();
        $Post->image = $file_name;
        $Post->save();
    }
}

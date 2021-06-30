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

    public function update(Request $request){
        $validated = $request->validate([
            'header' => '',
            'subHeader' => '',
            'mainText' => '',
            'postId' => 'required',
        ]);
        $Post = Post::where('id',$validated['postId']);
        //$Post->update($validated);

        if (array_key_exists('header', $validated)){
            $Post->update(['header' => $validated['header']]);
        }
        if (array_key_exists('subHeader', $validated)){
            $Post->update(['subHeader' => $validated['subHeader']]);
        }
        if (array_key_exists('mainText', $validated)){
            $Post->update(['mainText' => $validated['mainText']]);
            //$Post->mainText = $validated['mainText'];
        }
        //$Post->save();

    }

    public function uploadImage(Request $request, $postId){

        $validated = $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png',
        ]);


        $random = Str::random(40);
        $file_name = time().'_'.$random.'.'.$request->file->extension();
        $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

        $Post = Post::where('id',$postId)->first();
        $Post->image = $file_name;
        $Post->save();
    }
}

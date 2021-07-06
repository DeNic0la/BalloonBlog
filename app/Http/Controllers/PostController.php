<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{
    public function add(Request $request){
        $validated = $request->validate([
            'header' => 'required',
            'subHeader' => 'required',
            'mainText' => 'required',
        ]);

        if (Cache::has($validated['header'])){
            return 'Already Exists';
        }

        $Post = Auth::user()->posts()->create([
            'header' => $validated['header'],
            'subHeader' => $validated['subHeader'],
            'mainText' => $validated['mainText'],
        ]);

        Cache::put($validated['header'], 'exists', $seconds = 30);
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
        $fileName = time().'_'.$random.'.'.'jpg';// since all is encoded to jpg, this would be possible $request->file->extension();

        $img = $request->file('file');

        //Compressing
        $image = Image::make($img->getRealPath());
        $image->resize(650, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('jpg',80);

        Storage::disk('public')->put('/uploads/'.$fileName, $image);


        $Post = Post::where('id',$postId)->first();
        $Post->image = $fileName;
        $Post->save();
    }
}

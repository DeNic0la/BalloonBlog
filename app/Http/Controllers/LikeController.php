<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function like(Request $request){
        $validated = $request->validate([
            'postId' => 'required|integer',
        ]);
        $likeQuery = Like::where('post_id', $validated['postId'])->where('user_id', Auth::id());
        if($likeQuery->count() == 0) {
            Like::create([
                'post_id' => $validated['postId'],
                'user_id' => Auth::id(),
            ]);
            return json_encode([
                'state' => true,
            ]);
        }
        else {
            $likeQuery->first()->delete();
            return json_encode([
                'state' => false,
            ]);
        }
    }

    public function info(Request $request){
        $validated = $request->validate([
            'postId' => 'required|integer',
        ]);
        $PostLikes = Like::where('post_id', $validated['postId'])->count();
        if (Auth::check()){
            $UserLiked = (Like::where('post_id', $validated['postId'])->where('user_id', Auth::id())->count() > 0);
            return json_encode([
                'likeAmount' => $PostLikes,
                'userLike' => $UserLiked,
            ]);
        }
        return json_encode([
            'likeAmount' => $PostLikes,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    public function getImage(Request $request){
        $value = $request->validate([
            'name' => 'required',
        ]);
        $filename = $value['name'];
        //dd($filename);
        $path = storage_path("app\public\uploads\\".$filename);
        //dd($path);
        //$path = 'C:\Users\Nicola\Documents\GitHub\BalloonBlog\storage\app\public\uploads\1625044385_ 41 77 537 76 77 20210129_143933.jpg';
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;

    }
}

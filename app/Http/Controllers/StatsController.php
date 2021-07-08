<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class StatsController extends Controller
{
    public function index(){

        $statsImages = Cache::remember('stats', 3600, function () {

            $files = Storage::disk('public')->files('/stats');
            $imageNames = array();
            foreach ($files as $file) {
                $filePathArray = explode("/", $file);
                $seImageName = $filePathArray[1];
                array_push($imageNames,$seImageName);
            }
            return $imageNames;
        });

        return inertia::render('Stats/StatsContainer',['images' => $statsImages]);
    }
}

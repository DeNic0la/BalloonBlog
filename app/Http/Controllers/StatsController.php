<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class StatsController extends Controller
{
    public function index(){

        return inertia::render('Stats/StatsContainer');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;

class IndexController extends Controller
{
    public function index(){
        $ads = Ads::all();
        return view('index', compact('ads'));
    }
}

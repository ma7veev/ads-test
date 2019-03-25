<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;

class IndexController extends Controller
{
    public function index(){
        $ads = Ads::paginate(5);
        return view('index', compact('ads'));
    }
}

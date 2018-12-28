<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaticPagesController extends Controller
{
    public function home()
    {
        $list = [];
        if (Auth::check()) {
            $list = Auth::user()->feed()->paginate();
        }
       return view('static_pages.home', compact('list'));
    }
    public function help()
    {
        return view('static_pages.help');
    }
    public function about()
    {
        return view('static_pages.about');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('home')->with('articles', Article::all());
    }
}

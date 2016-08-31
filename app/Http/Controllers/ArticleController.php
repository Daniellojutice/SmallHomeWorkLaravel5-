<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends Controller
{
    public function show($id){
        return view('admin/article/show')->with('article', Article::with('hasManyComments')->find($id));
    }
}

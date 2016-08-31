<?php

namespace App\Http\Controllers\Admin;


use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class ArticleController extends Controller
{
    public function index(){
        return view('admin.article.index')->with('articles',Article::all());
    }

    public function create(){
        return view('admin/article/create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required|unique:articles|max:255',
            'body'=>'required',
        ]);

        $article = new Article();
        $article->title = $request->get('title');
        $article->body = $request->get('body');
        $article->user_id = $request->user()->id;

        if ($article->save()){
            return redirect('admin/article');
        }else{
            return redirect()->back()->withInput()->withErrors('SaveFailed');
        }
    }

    public function edit($id){
        $article = Article::find($id);
        return view('admin.article.edit')->with('article',$article);

    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'title'=>'required|max:255',
            'body'=>'required',
        ]);

        $article = Article::find($id);
        $article->title = $request->get('title');
        $article->body = $request->get('body');

        if ($article->save()){
            return redirect('admin/article');
        }else{
            return redirect()->back()->withInput()->withErrors('UpdateFailed');
        }
    }

    public function destroy($id){
        Article::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');

    }
}

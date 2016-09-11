<?php

namespace App\Http\Controllers\admin;


use App\Article;
use App\Comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index(){
        $articles = Article::
                    join('comments','articles.id','=','comments.article_id')
                    ->get(); //articles inner join comments only choose the exist article

        //$articles = Article::where('articles.id','=','comments.article_id')->with('hasManyComments')->get();


/*        $articles = Article::whereHas('hasManyComments', function ($query) {
                    $query->where('comments.article_id', '=', 'articles.id');
                })
                ->get();*/

       // $articles = Article::with('hasManyComments')->find(12);
       // $comments = $articles->hasManyComments->email;


        return view('admin/comment/index')->with('articles',$articles);
       // return view('admin/comment/index')->with('article',$article);
    }

    public function edit($id){
        $comment = Comment::find($id);
        return view('admin/comment/edit')->with('comment',$comment);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
           'nickname'=> 'max:100',
        ]);
        $comment = Comment::find($id);

        $comment->nickname = $request->get('nickname');
        $comment->email = $request->get('email');
        $comment->website = $request->get('website');
        $comment->content = $request->get('content');

        if ($comment->save()){
            return redirect('admin/comment');
        }else{
            return redirect()->back()->withInput()->withErrors('Fail');
        }
    }

    public function destroy($id){
        Comment::find($id)->delete();
        return redirect()->back()->withErrors('删除成功！');
    }
}

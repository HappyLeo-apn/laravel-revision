<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index', 'detail']);
    }
    public function index()
    {
        $data = Article::latest()->paginate(5);

        return view('articles.index', ['articles' => $data]);
    }
    public function detail($id)
    {
        $data = Article::find($id);
        return view('articles.detail', ['article' => $data]);
    }

    public function add()
    {
        $data = [
            ["id" => 1, "name" => "News"],
            ["id" => 2, "name" => "Tech"],
        ];

        return view('articles.add', ['categories' => $data]);
    }

    public function create(Article $article, Request $request)
    {
        // $article = new Article;

        $validator = Validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $article->title = $request->title;
        $article->body = request()->body; //or $request->body
        $article->category_id = request()->category_id;
        $article->save();
        // $data = [
        //     'title' => $request->title,
        //     'body' => $request->body,
        //     'category_id' => $request->category_id
        // ];
        // Article::create($data);
        return redirect('/articles');
    }

    public function delete($id){
        $article = Article::find($id);
        if(Gate::allows('article-delete', $article)){
            return redirect('/articles')->with('info', 'Article Deleted');
        }
        else {
            return back()->with('error', 'Unauthorized');
        }
        // return redirect('/articles')->with('info', 'Article Deleted');
    }
}

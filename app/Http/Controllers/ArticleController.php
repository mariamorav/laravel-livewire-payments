<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::paginate(4);

        return view('articles.index', compact('articles'));
    }
    
    public function show(Article $article) {

        return view('articles.show', compact('article'));
    
    }
}

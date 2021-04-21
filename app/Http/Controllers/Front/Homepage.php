<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Article;

class Homepage extends Controller
{
    public function index()
    {
      $cat = new Category;
      $art = new Article;
      $data['articles'] = $art->orderBy('id', 'desc')->get();
      $data['categories'] = $cat->orderBy('name', 'asc')->get();
      return view('front.index',$data);
    }
    public function single($slug){
      $cat = new Category;
      $article = Article::where('slug', '=', $slug)->first() ?? abort(403, 'Unauthorized.');
      $article->increment('hit');
      $data['article'] = $article ;
      $data['categories'] = $cat->orderBy('name', 'asc')->get();
      return view('front.single',$data);
    }
}

<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('id','DESC')->get();
        return view('back.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->post());
        $request->validate([
          'title'=>'min:3',
          'image'=>'image|max:2048'
        ]);

        $article = new Article;
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->slug = Str::slug($request->title, '-');

        if ($request->hasFile('thumb')) {
            $imageName = Str::slug($request->title, '-').'.'.$request->thumb->getClientOriginalExtension();
            $request->thumb->move(public_path('uploads'),$imageName);
            $article->thumb = '/uploads/'.$imageName;
        }
        $article->save();
        toastr()->success('Başarılı!', 'Makale başarıyla oluşturuldu.');
        return redirect()->route('admin.articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('back.articles.update',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
          'title'=>'min:3',
          'image'=>'image|max:2048'
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->slug = Str::slug($request->title, '-');

        if ($request->hasFile('thumb')) {
            $imageName = Str::slug($request->title, '-').'.'.$request->thumb->getClientOriginalExtension();
            $request->thumb->move(public_path('uploads'),$imageName);
            $article->thumb = '/uploads/'.$imageName;
        }
        $article->save();
        toastr()->success('Başarılı!', 'Makale başarıyla güncellendi.');
        return redirect()->route('admin.articles.edit',$id);
    }

    public function changeStatus(Request $request){

        $article = Article::findOrFail($request->id);
        $article->status = $request->statu=='true' ? 1 : 0;
        $article->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        Article::find($id)->delete();
        toastr()->success('Başarılı!', 'Makale başarıyla silindi.');
        return redirect()->route('admin.articles.index');
    }
}

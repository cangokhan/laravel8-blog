<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
      $categories = Category::all();
      return view('back.categories.index',compact('categories'));
    }

    public function add(Request $request){
      $isExist = Category::whereSlug(Str::slug($request->title, '-'))->first();
      if ($isExist) {
        toastr()->error($request->title.' adinda bir kategori zaten mevcut.');
        return redirect()->back();
      }
      $category = new Category();
      $category->name = $request->title;
      $category->slug = Str::slug($request->title, '-');
      $category->save();
      toastr()->success('Başarılı!', 'Kategori başarıyla oluşturuldu.');
      return redirect()->back();
    }

    public function changeStatus(Request $request){
        $category = Category::findOrFail($request->id);
        $category->status = $request->statu=='true' ? 1 : 0;
        $category->save();
    }

    public function getData(Request $request){
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }

}

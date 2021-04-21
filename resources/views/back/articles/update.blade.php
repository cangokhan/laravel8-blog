@extends('back.layouts.master')
@section('title',$article->title." Güncelle")
@section('content')
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"> @yield('title')</h6>
      </div>
      <div class="card-body">
        @if ($errors->any())
          <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                {{$error}}
              @endforeach
          </div>
        @endif
          <form class="" action="{{route('admin.articles.update',$article->id)}}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <div class="form-group">
                  <label for="">Makale Başlığı</label>
                    <input type="text" name="title" class="form-control" required value="{{$article->title}}">
              </div>
              <div class="form-group">
                  <label for="">Makale Kategori</label>
                    <select class="form-control" name="category" required>
                        <option value="">Seçiniz</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if ($article->category_id == $category->id) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
              </div>
              <div class="form-group">
                  <label for="">Görsel</label> <br>
                  @if (!empty($article->thumb))
                    <img src="{{$article->thumb}}" alt="{{$article->title}}"  class="rounded img-thumbnail" width="250">
                  @endif
                    <input type="file" name="thumb" class="form-control">
              </div>
              <div class="form-group">
                  <label for="">İçerik</label>
                    <textarea name="content" class="summernote form-control" rows="8" cols="80">{!!$article->content!!}</textarea>
              </div>

              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block" name="subb"> Güncelle </button>
              </div>
          </form>
      </div>
  </div>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
        height : 300
      });
      });
  </script>
@endsection

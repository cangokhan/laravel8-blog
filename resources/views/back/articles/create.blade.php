@extends('back.layouts.master')
@section('title','Makale Ekle')
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
          <form class="" action="{{route('admin.articles.store')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                  <label for="">Makale Başlığı</label>
                    <input type="text" name="title" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="">Makale Kategori</label>
                    <select class="form-control" name="category" required>
                        <option value="">Seçiniz</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
              </div>
              <div class="form-group">
                  <label for="">Görsel</label>
                    <input type="file" name="thumb" class="form-control">
              </div>
              <div class="form-group">
                  <label for="">İçerik</label>
                    <textarea name="content" class="summernote form-control" rows="8" cols="80"></textarea>
              </div>

              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block" name="subb"> Makale Ekle </button>
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

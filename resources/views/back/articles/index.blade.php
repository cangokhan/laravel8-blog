@extends('back.layouts.master')
@section('title','Tüm Makaleler')
@section('content')
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"> <strong>{{$articles->count()}}</strong> makale bulundu </h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Fotoğraf</th>
                          <th>Başlık</th>
                          <th>Kategori Adı</th>
                          <th>İcerik</th>
                          <th>Durum</th>
                          <th>Tarih</th>
                          <th>İşlemler</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($articles as $article)
                      <tr>
                          <td> <img src="{{$article->thumb}}" alt="{{$article->title}}" width="200" height="200"> </td>
                          <td>{{$article->title}}</td>
                          <td>{{$article->getCategory->name}}</td>
                          <td>{{$str=Str::of($article->content)->substr(0,70)}}</td>
                          <td>
                            <input class="switch" type="checkbox" @if($article->status == 1) checked @endif data-id="{{$article->id}}" data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-danger" data-on="Aktif" data-off="Pasif">
                          </td>
                          <td>{{$article->created_at->diffForHumans()}}</td>
                          <td>
                            <a href="#" title="Görüntüle" class="btn btn-sm btn-success"> <i class="fa fa-eye"></i> </a>
                            <a href="{{route('admin.articles.edit',$article->id)}}" title="Düzenle" class="btn btn-sm btn-primary"> <i class="fa fa-pen"></i> </a>
                            <a href="{{route('admin.deleteArticle',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"> <i class="fa fa-times"></i> </a>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
@endsection

@section('css')
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script>
  $(function() {
    $('.switch').change(function() {
      id =  $(this).data('id');
      statu = $(this).prop('checked');
      $.get("{{route('admin.changeStatus')}}",{id:id,statu:statu}, function(data, status){});
    })
  })
</script>
@endsection

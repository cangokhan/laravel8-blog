@extends('back.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')
  <div class="row">
      <div class="col-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Yeni Kategori Oluştur </h6>
            </div>
            <div class="card-body">
              <form class="" action="{{route('admin.category.add')}}" method="post" enctype="multipart/form-data">
                @csrf
                  <div class="form-group">
                      <label for="">Kategori Adı</label>
                        <input type="text" name="title" class="form-control" required>
                  </div>

                  <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block" name="subb"> Kategori Ekle </button>
                  </div>
              </form>
            </div>
        </div>
      </div>
      <div class="col-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Kategori Listesi </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Başlık</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->articleCount()}}</td>
                                <td>
                                  <input class="switch" type="checkbox" @if($category->status == 1) checked @endif data-id="{{$category->id}}" data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-danger" data-on="Aktif" data-off="Pasif">
                                </td>
                                <td>
                                  <a title="Güncelle" data-id="{{$category->id}}" class="btn btn-sm btn-primary edit-click"> <i class="fa fa-edit"></i> </a>
                                  {{-- <a href="{{route('admin.categories.edit',$category->id)}}" title="Düzenle" class="btn btn-sm btn-primary"> <i class="fa fa-pen"></i> </a>
                                  <a href="{{route('admin.deleteArticle',$category->id)}}" title="Sil" class="btn btn-sm btn-danger"> <i class="fa fa-times"></i> </a> --}}
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
  </div>

  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Kategoriyi Düzenle</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form class="" action="" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <div class="form-group">
                  <label for="">Başlık</label>
                    <input type="text" id="title" name="title" class="form-control" required value="">
              </div>
              <div class="form-group">
                  <label for="">Kategori Slug</label>
                    <input type="text" id="slug" name="title" class="form-control" required value="">
              </div>
              <div class="form-group float-right">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                  <button type="submit" class="btn btn-primary " name="subb"> Güncelle </button>
              </div>
          </form>
        </div>
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
    $('.edit-click').click(function(){
      id =  $(this).data('id');
      $.ajax({
        type:'GET',
        url:'{{route('admin.category.getData')}}',
        data:{id:id},
        success:function(data){
          console.log(data);
          $('#title').val(data['name']);
          $('#slug').val(data['slug']);
          $('#myModal').modal('show');
        }
      });
    });
    $('.switch').change(function() {
      id =  $(this).data('id');
      statu = $(this).prop('checked');
      $.get("{{route('admin.categoryStatusChange')}}",{id:id,statu:statu}, function(data, status){});
    })
  })
</script>
@endsection

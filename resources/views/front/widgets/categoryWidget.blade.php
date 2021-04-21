@isset($categories)
  <div class="col-lg-3 col-md-3">
    <div class="card">
      <div class="card-header">
        Kategoriler
      </div>
      <div class="list-group">
        <?php $a=0;?>
        @foreach ($categories as $category)
          <a href="#" class="list-group-item list-group-item-action @if($a == 0) active @endif">
            {{$category->name}}
            <span class="badge bg-danger text-white float-right"> {{$category->articleCount()}} </span>
          </a>
          <?php $a++;?>
        @endforeach
      </div>
    </div>
  </div>

@endisset

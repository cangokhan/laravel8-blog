@extends('front.layouts.master')
@section('title','Anasayfa | Blog Sitesi')
@section('content')

  @include('front.widgets.categoryWidget')
  <div class="col-lg-9 col-md-9 mx-auto">
    @foreach ($articles as $article)
      <div class="post-preview">
        <a href="{{route('single',$article->slug)}}">
          <img src="{{$article->thumb}}" alt="{{$article->title}}" class="img-responsive" style="    width: 100%;">
          <h2 class="post-title">
            {{$article->title}}
          </h2>
          <h3 class="post-subtitle">
            {!!$str=strip_tags(Str::of($article->content)->substr(0,70))!!}
          </h3>
        </a>
        <p class="post-meta">Kategori :
          <a href="#">{{$article->getCategory->name}}</a>
          <span class="float-right">{{$article->created_at->diffForHumans()}}</span>
        </p>
      </div>
      @if (!$loop->last)
        <hr>
      @endif
    @endforeach
    <!-- Pager -->
    <div class="clearfix">
      <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
    </div>
  </div>
@endsection

@extends('front.layouts.master')
@section('title',$article->title)
@section('bg',$article->thumb)
@section('content')

  @include('front.widgets.categoryWidget')
  <div class="col-lg-9 col-md-9 mx-auto">
    <article>
      <div class="container">
        <div class="row">
          {!!$article->content!!}
        </div>
      </div>
    </article>
  </div>
@endsection

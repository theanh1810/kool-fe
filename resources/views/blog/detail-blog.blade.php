@extends('layouts.index')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12 col-sm-12 col-lg-12 col-md-12">
      <div class="cate__blog">
        <div class="cate__blog-left col-lg-3">
          <div class="title__cate-blog">
            Tin Nổi Bật
          </div>
          @foreach ($post as $value )

          <div class="cate__blog-item-left">
            <div class="block-img"><img src="{{asset("/image/main/" .$value->pos_image)}}" alt=""></div>
            <div class="cate__blog-left-content">
              <a href="{{route('blog-detail', ['slug' => $value->pos_slug , 'id' => $value->pos_id]);}}">
                <div>{{$value->pos_title}}</div>
              </a>
              <div class="cate__blog-left-date"><i class="bi bi-calendar-date"></i>{{date('H:i d-m-Y', $value->pos_created_at)}}</div>
            </div>
          </div>

          @endforeach
          </div>


        <div class="detail__blog-right col-lg-9">
          <div class="detail__blog-date"><i class="bi bi-calendar-date"></i>{{date('H:i d-m-Y', $post_content[0]->pos_created_at)}}</div>
          <div class="detail__blog-title">{{$post_content[0]->pos_title}}</div>
          {!!$post_content[0]->pos_content!!}
        </div>
                    

      </div>
    </div>
  </div>
</div>


@endsection
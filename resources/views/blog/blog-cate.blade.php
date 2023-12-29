@extends('layouts.index')

@section('content')

<div class="container">
  <div class="row">
    <div class=" d-flex">
      <div class="cate__blog">
        <div class="cate__blog-left">
          <div class="title__cate-blog">
            Tin Nổi Bật
          </div>
          @foreach ($post as $value )

          <div class="cate__blog-item-left ">
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


        <div class="cate__blog-right ">
                    @foreach ($post as $value )
          <div class="cate__blog-right-item">
            <div class="cate__blog-right-img"><img src="{{asset("/image/main/" .$value->pos_image)}}" alt=""></div>
            <a href="{{route('blog-detail', ['slug' => $value->pos_slug , 'id' => $value->pos_id]);}}">
              <div class="cate__blog-right-title">{{$value->pos_title}}</div>
            </a>
            <div class="cate__blog-right-date"><i class="bi bi-calendar-date"></i>{{date('H:i d-m-Y', $value->pos_created_at)}}</div>
            <div class="cate__blog-right-content">{{$value->pos_excerpt}}</div>
          </div>
          @endforeach
        </div>
                    

      </div>
    </div>
  </div>
</div>

@endsection
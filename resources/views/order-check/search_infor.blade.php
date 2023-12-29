@extends('layouts.index')

@section('content')

<div class="search-infor__body row">
    <div class="col"></div>
    <div class="col-lg-5 col-10 search-infor__container">
        <div class="search-infor__check-icon">
            <i class="bi bi-check-circle-fill bg-white "></i>
        </div>
        <div class="search-infor__img-holder">
            <img class="search-infor__img" src="{{asset("image/warranty/warranty1.svg")}}" alt="">
        </div>
        <div class="search-infor__text">
            @if(empty($ord_code))
            Không tìm thấy mã đơn hàng. Vui lòng liên hệ với Kool  để được hỗ trợ
            @else
            Mã đơn hàng: {{$ord_code->ord_code}} của bạn đã được đóng gói và giao cho đơn vị vận 
            @endif
        </div>
    </div>
    <div class="col"></div>
</div>
@endsection
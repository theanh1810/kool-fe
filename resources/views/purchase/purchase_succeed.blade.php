@extends('layouts.index')

@section('content')
<div class="purchase-succeeded">
    <div class="purchase-succeeded--holder">
        <img class="w-100" src="{{asset("image/purchase-succeeded.svg")}}" alt="">
    </div>
    <div class="fs-4 mt-2 mb-4">
        Đặt hàng thành công
    </div>
    <div class="purchase-succeeded__body">
        <div class="purchase-succeeded__payment-congrad--primary">Chào, {{$data_order_success['ord_name_cus']}}</div>
        <div class="purchase-succeeded__payment-congrad--secondary">Chúc mừng bạn đã đăng ký thành công!</div>
        <div class="row purchase-succeeded__payment-detail">
            <div class="col purchase-succeeded__payment-detail--attribute">
                <p>Mã đơn hàng</p>

            </div>
            <div class="col purchase-succeeded__payment-detail--value">
                <p>: {{$data_order_success['ord_code']->ord_code}}</p>

            </div>
        </div>
        <div class="row purchase-succeeded__payment-detail">
            <div class="col purchase-succeeded__payment-detail--attribute">
                <p>Phương thức thanh toán</p>

            </div>
            <div class="col purchase-succeeded__payment-detail--value">

                <p>: Thanh toán khi nhận hàng</p>

            </div>
        </div>
        <div class="row purchase-succeeded__payment-detail">
            <div class="col purchase-succeeded__payment-detail--attribute">

                <p>Thời gian giao hàng dự kiến</p>

            </div>
            <div class="col purchase-succeeded__payment-detail--value">

                <p>: 3-4 ngày</p>

            </div>
        </div>
        <div class="row purchase-succeeded__payment-detail">
            <div class="col purchase-succeeded__payment-detail--attribute">

                <p>Tổng thanh toán</p>

            </div>
            <div class="col purchase-succeeded__payment-detail--value">

                <p style="color: #cd1270;">: {{currency_format($data_order_success['ord_price_pay'])}}</p>

            </div>
        </div>
        <div class="row purchase-succeeded__payment-detail purchase-succeeded__payment-detail--end ">
            <div class="col purchase-succeeded__payment-detail--attribute">

                <p>Tình trạng</p>
            </div>
            <div class="col purchase-succeeded__payment-detail--value">

                <p style="color: #cd1270;">: Đã thanh toán</p>
            </div>
        </div>
        <p class=" purchase-succeeded__payment-notice">Mọi thông tin về đơn hàng sẽ được Kính mắt Kool gửi về email của
            bạn. Vui lòng kiểm tra email để biết thêm chi tiết</p>
        <p class=" purchase-succeeded__payment-thanks">Kính mắt Kool xin chân thành cảm ơn!</p>
    </div>
    <a href="http://127.0.0.1:8000/" class="hvr-buzz-out"><button class="purchase-succeeded__payment-confirm">QUAY VỀ TRANG CHỦ</button></a>
</div>
@endsection
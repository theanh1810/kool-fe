@extends('layouts.index')

@section('content')
<form class="purchase-form" action="{{url('get-order')}}"method="post">
    <div class=" row">
        <div class="col-12 col-lg-5 purchase-form--part">
            <div class="form__heading">THÔNG TIN MUA HÀNG</div>
            <div class="form__body">
                <div class="input__item">
                    <div class="input__item--subject"><span style="color: red">*</span> Số điện thoại</div>
                    <div class="input__item--input-box">
                        <input type="text" class='input__item--text' placeholder="Nhập số điện thoại" name="numberPhone">
                        <p class="help is-danger">{{ $errors->first('numberPhone') }}</p>
                    </div>
                </div>
                <input class="form-check-input email-send hidden" type="checkbox" id=""><span class="purchase--notice__body hidden" style="margin-left: 0.7rem;">Gửi cho tôi tin tức và ưu đãi qua email</span>
                <div class="row">
                    <div class="col">
                        <div class="input__item">
                            <div class="input__item--subject"><span style="color: red">*</span> Họ và tên</div>
                            <div class="input__item--input-box">
                                <input type="text" class='input__item--text' name='fullName'>
                                <p class="help is-danger">{{ $errors->first('fullName')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input__item">
                            <div class="input__item--subject"><span style="color: red">*</span> Giới Tính</div>
                            <div class="input__item--input-box">
                                 <select id="sex-customer" class="form-control input__item--text sex-class" name="sex_customer" >
                                    <option class="place_option" value="">Vui lòng chọn giới tính</option>                                     
                                    <option value="0">Nam</option>
                                    <option value="1">Nữ</option>
                                    <option value="2">Giới Tính Khác</option> 
                                 </select>     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="form-location-purchase">
                    <div class="col">
                        <div class="input__item">
                            <div class="input__item--subject"><span style="color: red">*</span>Tỉnh/ Thành Phố</div>
                            <div class="input__item--input-box">
                                <select id="city-select" class="form-control city_class input__item--text" name="select_city" >
                                <option class="place_option" value="">Vui lòng chọn khu vực Tỉnh/ Thành phố</option>
                                @foreach ($all_city_district as $key => $city)
                                <option class="district-option {{'city_value-'.$key}}" value="{{$city['cit_id']}}">{{$city['cit_name']}}</option>                                    
                                @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="col">
                        <div class="input__item">
                            <div class="input__item--subject"><span style="color: red">*</span> Quận/ Huyện</div>
                            <div class="input__item--input-box">
                                <select id="district-select" class="form-control district_class input__item--text" name="select_district" placeholder="Vui lòng chọn khu vực Tỉnh/ Thành phố">
                                <option class="place_option" value="">Vui lòng chọn khu vực Quận/ Huyện</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="input__item">
                            <div class="input__item--subject"><span style="color: red">*</span> Phường/ Xã</div>
                            <div class="input__item--input-box">
                                <select id="ward-select" class="form-control ward_class input__item--text" name="select_ward" placeholder="Vui lòng chọn khu vực Tỉnh/ Thành phố">
                                <option class="place_option" value="">Vui lòng chọn khu vực Phường/ Xã</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input__item">
                    <div class="input__item--subject"><span style="color: red">*</span> Địa chỉ</div>
                    <div class="input__item--input-box">
                        <input type="text" class='input__item--text' placeholder="Nhập địa chỉ đường phố" name='detailAddress'>
                        <p class="help is-danger">{{ $errors->first('detailAddress') }}</p>
                    </div>
                </div>

                <div class="input__item">
                    <div class="input__item--subject"><span style="color: red">*</span>Địa chỉ email</div>
                    <div class="input__item--input-box">
                        <input class='input__item--text ' type="text" name='email' placeholder="Nhập địa chỉ Email">
                        <p class="help is-danger">{{ $errors->first('email')}}</p>
                    </div>
                </div>


                {{-- <div class="purchase--notice">
                    <div class="purchase--notice__title">* Phiếu khám mắt</div>
                    <div class="purchase--notice__body">
                        Phiếu khám mắt được cung cấp bởi kỹ thuật viên đo khúc xạ. Bao gồm các thông số quan trọng như số độ cận, viễn loạn, số đo PD… giúp chúng tôi cắt kính chính xác và thoải mái nhất cho đôi mắt của bạn.
                    </div>
                </div> --}}
                {{-- <button class="upload-btn mt-3">
                    <div>
                        Tải lên phiếu khám mắt
                    </div>
                    <div class="upload-btn--image">
                        <img class="w-100"  src="../../assets/image/upload.png" alt=""> 
                    </div>
                </button> --}}
                  
            </div>
        </div>
        <div class="col-lg-6 col-12 purchase-form--part position-relative">
            <div class="form__heading" id="cart__heading">GIỎ HÀNG CỦA BẠN</div>
                <div class="purchase-form-block">
                <input type="hidden" value="{{Cart::count()}}" class="cart__discart-render" name="cart__discart-render">
                @foreach ( Cart::content() as $key => $Cart )
                    <div class="d-flex align-items-center w-100 position-relative item-in-cart">
                        <div class="cart__img--holder">
                            <img class="w-100" src="{{$Cart->options['image_pro']}}" alt="">
                        </div>
                        <div class="cart-item-name-block">
                            <div class="cart-item--text brand-purchase" >Brand: {{$Cart->options['brand_pro']}}</div>
                            <div class="cart-item--text name-purchase" >{{$Cart->name}}</div>
                            <input type="hidden" value="{{$Cart->name}}" name='{{'data_pro['.$key.'][pro_name]'}}'>
                            <input class="hidden-data pro-id-purchase" type="hidden" name="{{'data_pro['.$key.'][pro_id]'}}" value="{{$Cart->options['pro_id']}}">
                            <input class="hidden-data prv-id-purchase" type='hidden' name="{{'data_pro['.$key.'][prv_id]'}}" value="{{$Cart->id}}">
                        </div>
                        <div class="input-group--holder">
                            <div class="input-group input__qty-purchase">
                                <div class="input-group-prepend" style="width: 33.3333%">
                                  <button class="h-100 decrementBtn" style="border: 1px solid #DDDDDC;width: 100%;" type="button" >-</button>
                                </div>
                                <div style="width: 33.3333%" class="qty__group-purchase">
                                    <input type="text" name="{{'data_pro['.$key.'][qty]'}}" class=" w-100 text-center quantityInput" style="border: 1px solid #DDDDDC" value="{{$Cart->qty}}">
                                </div>
                    
                                <div class="input-group-append" style="width: 33.3333%">
                                  <button class="h-100 incrementBtn" style="border: 1px solid #DDDDDC;width: 100%" type="button" >+</button>
                                </div>
                            </div>
                        </div>
                        <div class="cart__prize--holder">
                            <div class="primary-prize" >{{currency_format($Cart->price)}}</div>
                            <input class="hidden-data primary-prize-input" type='hidden' name="{{'data_pro['.$key.'][price_pro]'}}" value="{{$Cart->price}}">
                        </div>
                        <button class="cart__discard" type="submit"  value="{{$Cart->rowId}}" >x</button>
                    </div>
                    @endforeach
                </div>
                
                <div class="purchase--payment">
                    <div class="row payment-count--holder">
                        <div class="col p-0">Tạm tính</div>
                        <div class="col p-0 total-first" style="text-align: right;">
                            <input type="hidden" name="total-price"  value="{{Cart::total('0','','')}}">
                            @if(Cart::count() == 0)
                            0đ
                            @else
                            {{currency_format(Cart::total('0','',''))}}
                            @endif
                        </div>
                    </div>
                    <div class="row payment-count--holder">
                        <div class="col p-0">Phí vận chuyển</div>
                        <div class="col p-0" style="text-align: right;">0đ</div>
                    </div>
                    <div class="row payment-count--holder">
                        <div class="col p-0">Giảm Giá</div>
                        <div class="col p-0 total-sale"  style="text-align: right;">0đ</div>
                        <input type="hidden" value="0" name="total-sale">
                    </div>
                    <div class="row payment-count--holder pt-4" style="padding-bottom: 20px">
                        <div class="col p-0">TỔNG ĐƠN HÀNG</div>
                        <div class="col p-0 total-all"  style="text-align: right;">                            
                            <input type="hidden" value="{{Cart::total('0','','')}}" name="total_after_sale">
                            @if(Cart::count() == 0)
                            0đ
                            @else
                            {{currency_format(Cart::total('0','',''))}}
                            @endif
                        </div>
                    </div>
                </div>
                    <div class="col-lg-12 col-12 purchase-form--submit">
                        <div class="form__heading hidden">HÌNH THỨC THANH TOÁN</div>
                        <div class="form__body">
                         <div class="hidden">Có 3 hình thức thanh toán và ô tích cho khách hàng click vào khi lựa chọn: </div>
                        <div class="payment-method--item">
                             <input type="checkbox" checked>
                              <span>THANH TOÁN KHI NHẬN ĐƯỢC HÀNG</span>
                         </div>
                        <button type="submit" class="purchase-confirm--btn mt-3 hvr-bounce-out">THANH TOÁN</button>
                    </div>
            </div>
        </div>
    </div>
</form>

<script>
    
$(document).ready(function () {
    function currency_format(number, suffix = "đ") {
        if (!isNaN(number)) {
            return new Intl.NumberFormat("vi-VN", {
                style: "currency",
                currency: "VND",
            }).format(number);
        } else {
            return "0 " + suffix; // Trả về giá trị mặc định nếu không phải là một số hợp lệ
        }
    }
    var countCart = @json(Cart::count());
    if(countCart == 0){
        $(".purchase-form-block").append("Giỏ hàng của bạn trống");
    }else{
       
    $(".cart__discard").on("click", function (e) {
        var count_pro = @json(session('count_pro'));
        e.preventDefault();
        var rowId = $(this).val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: window.location.origin + "/remove-cart", // Đường dẫn route để thêm sản phẩm vào giỏ hàng
            data: {
                rowId: rowId,
            },
            success: function (data) {
                $(".purchase-form-block").remove();
                $(".purchase--payment").remove();
                $("#cart__heading").after(data);
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    });
}
    $(".incrementBtn").on("click", function () {
        var inputElement = $(this).parent(".input-group-append");
        var parentOrigin =inputElement.siblings(".qty__group-purchase");
        var childQty = parentOrigin.find(".quantityInput");
        var parentRowId =inputElement.parent(".input__qty-purchase");
        var parentRowId_1 = parentRowId.parent(".input-group--holder");
        var rowIdNear = parentRowId_1.siblings(".cart__discard");
        var rowId = rowIdNear.val();
        var inputValue = parseInt(childQty.val());
        var inputValueUpdate = inputValue + 1;
        childQty.val(inputValueUpdate);
        $.ajax({
            type: "POST",
            dataType: "text",
            url: window.location.origin + "/change-cart", // Đường dẫn route để thêm sản phẩm vào giỏ hàng
            data: {
                rowId: rowId,
                inputValue: inputValueUpdate,
            },
            success: function (data) {
                $(".count__pro-cart").empty();
                $(".count__pro-cart").append(data);
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        })
        
    });

    $(".decrementBtn").on("click", function () {
        var inputElement = $(this).parent(".input-group-prepend");
        var parentOrigin =inputElement.siblings(".qty__group-purchase");
        var childQty = parentOrigin.find(".quantityInput");
        var parentRowId =inputElement.parent(".input__qty-purchase");
        var parentRowId_1 = parentRowId.parent(".input-group--holder");
        var rowIdNear = parentRowId_1.siblings(".cart__discard");
        var rowId = rowIdNear.val();
        var inputValue = parseInt(childQty.val());
        if( inputValue > 1){
            var inputValueUpdate = inputValue - 1;
        }else{
            var inputValueUpdate = 1;
        }
        childQty.val(inputValueUpdate);
        $.ajax({
            type: "POST",
            dataType: "text",
            url: window.location.origin + "/change-cart", // Đường dẫn route để thêm sản phẩm vào giỏ hàng
            data: {
                rowId: rowId,
                inputValue: inputValueUpdate,
            },
            success: function (data) {
                $(".count__pro-cart").empty();
                $(".count__pro-cart").append(data);
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        })
        
    });
});
</script>
@endsection
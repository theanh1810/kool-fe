
             @if (Cart::count() == 0)
                <input type="hidden" value="{{$count_pro}}" class="cart__discart-render" name="cart__discart-render">
               <div class="cart__empty">Giỏ hàng của bạn trống</div>
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
                <script>
                        var count_pro = $(".cart__discart-render").val();
                        $(".count__pro-cart").empty();
                        $(".count__pro-cart").append(count_pro);
                </script>
              @else
                <div class="purchase-form-block">
                <input type="hidden" value="{{$count_pro}}" class="cart__discart-render" name="cart__discart-render">
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
    var count_pro = $(".cart__discart-render").val();
    $(".count__pro-cart").empty();
    $(".count__pro-cart").append(count_pro);


    $(".cart__discard").on("click", function (e) {
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
@endif  
                
                

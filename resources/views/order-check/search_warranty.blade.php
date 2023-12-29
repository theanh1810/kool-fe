@extends('layouts.index')

@section('content')
<form method="get" action="{{url('get-info-warranty')}}" class="search-order__body row">
    <div class="col"></div>
    <div class="col-lg-5 search-order__container">
        <div class="search-order__title">Tra cứu bảo hành sản phẩm theo thông tin</div>
        <div class="row search-order__section">
            <div class="col-3 search-order__section--title">Số điện thoại <span style="color: red">*</span></div>
            <div class="col-9">
                <input class="search-order__input w-100" type="text" name="numberPhoneCheck">
            </div>
            <p class="help is-danger" style="margin-left: 170px">{{ $errors->first('numberPhoneCheck') }}</p>
        </div>
        <div class="row search-order__section">
            <div class="col-3 search-order__section--title">Mã đơn hàng <span style="color: red">*</span></div> 
            <div class="col-9">
                <input class="search-order__input w-100" type="text" name="OrderCodeCheck" >
            </div>
            <p class="help is-danger" style="margin-left: 170px">{{ $errors->first('OrderCodeCheck') }}</p>
        </div>

        <button type="submit" class="search-order__button w-100 hvr-glow">TRA CỨU BẢO HÀNH</button>
    </div>
    <div class="col"></div>
</form>
@endsection
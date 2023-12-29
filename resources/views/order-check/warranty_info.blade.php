@extends('layouts.index')

@section('content')
@if(empty($pro_info_check))
<div class="search-infor__body row">
    <div class="col"></div>
    <div class="col-lg-5 col-10 search-infor__container">
        <div class="search-infor__text">
            Không tìm thấy mã đơn hàng. Vui lòng liên hệ với Kool để được hỗ trợ
        </div>
    </div>
    <div class="col"></div>
</div>
@else
<div class="container cus_info-warranty">
  <div class="warranty_left">
    <div class="title_warranty">Thông tin khách hàng</div>
    <div class="ord_code">Mã Đơn Hàng: {{$ord_code}}</div>
    <div class="cus_info ">
      <div class="cus_info_left">
        <div class="con__cus bg-blue">
          <div class="name cus-tit">Họ và tên</div>
          <div class="name-value cus-attr">{{$pro_info_check['cus_info'][0]->ord_fullname}}</div>
        </div>
        <div class="con__cus bg-blue-2">
          <div class="birthday cus-tit">Ngày sinh</div>
          <div class="birthday-value cus-attr">
            @if(empty($pro_info_check['cus_info'][0]->ord_year_of_birth))
            @else
            {{$pro_info_check['cus_info'][0]->ord_year_of_birth}}
            @endif
          </div>
        </div>
        <div class="con__cus bg-blue">
          <div class="phone cus-tit">Số Điện Thoại</div>
          <div class="phone-value cus-attr">{{$phone_number}}</div>
        </div>
        <div class="con__cus bg-blue-2">
          <div class="email cus-tit">Email</div>
          <div class="email-value cus-attr">
            @if(empty($pro_info_check['cus_info'][0]->ord_email))
            @else
            {{$pro_info_check['cus_info'][0]->ord_email}}
            @endif
          </div>
        </div>
        <div class="con__cus bg-blue">
          <div class="address cus-tit">Địa chỉ</div>
          <div class="address-value cus-attr">{{$address_full}}</div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-9 warranty_right">
      <div class="title_warranty">Thông tin sản phẩm bảo hành</div>
        @if($pro_info_check['war_info']->isEmpty())
        <div class="tit_pro-info" style="margin-top: 60px">Không có sản phẩm nằm trong chương trình bảo hành. Vui lòng liên hệ với Kool để được hỗ trợ</div>
        @else
      <div class="con__pro-wanrranty">
          <div class="con_pro_wanrranty-title">

            <div class="img__pro" style="width:10%">
              <div class="tit__img-pro bg-blue-2 tit_pro-info">Ảnh sản phẩm</div>
            </div>
              <div class="name_pro bg-blue"  style="width: 30%">
                <div class="name__pro-tit tit_pro-info">Tên sản phẩm</div>
              </div>
            <div class="pro__sku bg-blue-2 " style="width: 20%">
              <div class="pro__sku-tit tit_pro-info">Mã sản phẩm</div>
            </div>
            <div class="color__pro bg-blue" style="width: 10%">
              <div class="color__pro-tit  tit_pro-info">Màu sản phẩm</div>
             </div>
            <div class="brand__pro bg-blue-2" style="width:10%">
              <div class="brand__pro-tit tit_pro-info">Thương hiệu</div>
            </div>
            <div class="time-warranty bg-blue" style="width:20%">
              <div class="warranty__time-tit tit_pro-info">Thời hạn bảo hành</div>
            </div>
          </div>
          @foreach ($pro_info_check['war_info'] as $product)
            <div class="con_product">
              <div class="img__pro" style="width:10%">
                <div class="pro__check-value" style="height: 95px; padding: 5px ; border: 1px solid #00000020; border-left: unset; border-bottom: unset"><img src="{{"https://crm.kinhmatkool.com/uploads/picture/product/small/".$product['pro_image']}}" alt="" style="width: 100%; object-fit: contain;"></div>
              </div>
              @php $url = route('detail_product', ['slug' => $product['pro_slug'], 'id' => $product['pro_id']]); @endphp
              <a class="name_pro-link " href="{{$url."?variant_id=".$product['prv_id']}}" style="width: 30%">
                <div class="name_pro bg-blue">
                  <div class="pro__check-value" style="height: 95px;">{{$product['pro_name']}}</div>
                </div>
              </a>
              <div class="pro__sku bg-blue-2" style="width: 20%">
                <div class="pro__check-value" style="height: 95px;">{{$product['prv_sku']}}</div>
              </div>
              <div class="color__pro bg-blue" style="width: 10%">
                <div class="pro__check-value" style="height: 95px;">{{$product['prv_name']}}</div>
              </div>
              <div class="brand__pro bg-blue-2" style="width:10%">
                <div class="pro__check-value" style="height: 95px;">{{$product['brand_name']}}</div>
              </div>
              <div class="time-warranty pro_check-time bg-blue" style="width:20%">
                <div  class="start-warranty pro__check-value">Từ: {{date('d-m-Y', $product['war_time_from'])}}</div>
              <div class="end-warranty pro__check-value">Đến: {{date('d-m-Y', $product['war_time_to'])}}</div>
              </div>
            </div>
            @endforeach
      </div>
      @endif
  </div>

</div>
@endif

@endsection
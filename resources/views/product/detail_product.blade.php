@extends('layouts.index')

@section('content')
<div class="container">
    <div class="">
        <div class="col-11 product-detail__container">
            <!-- slider column -->
            @if(empty($pro_image_record))
            <div class="img__main-detail col-lg-6" style="margin-left: 10%; margin-top: 2%" data-slide-number="0">
                <div id="owl-main" class="owl-carousel owl-theme">
                    <div class="item">
                        <img src="https://via.placeholder.com/627x627.png?text=Kinhmatkool.com" alt=""
                            class="img__main-slider">
                    </div>
                </div>
            </div>
            <div id="owl__column-main" class="owl-carousel owl-theme" style="position: absolute;">
                <div class="item slider__column">
                    <img src="https://via.placeholder.com/68x68.png?text=Kinhmatkool.com" alt="">
                </div>
                <div class="item slider__column">
                    <img src="https://via.placeholder.com/68x68.png?text=Kinhmatkool.com" alt="">
                </div>
                <div class="item slider__column">
                    <img src="https://via.placeholder.com/68x68.png?text=Kinhmatkool.com" alt="">
                </div>
                <div class="item slider__column">
                    <img src="https://via.placeholder.com/68x68.png?text=Kinhmatkool.com" alt="">
                </div>
            </div>
            @else
            <div class="img__main-detail col-lg-6 " style="margin-left: 10%; margin-top: 2%" data-slide-number="0">
                <div id="owl-main" class="owl-carousel owl-theme">
                    @foreach ($pro_image_record as $pro_image )
                    <div class="item">
                        <img src="{{'https://crm.kinhmatkool.com/uploads/picture/product/large/' . $pro_image->pri_name}}"
                            alt="" class="img__main-slider">
                    </div>
                    @endforeach
                </div>
            </div>
            <div id="owl__column-main" class="owl-carousel owl-theme">
                @foreach ($pro_image_record as $pro_image)
                <div class="item slider__column">
                    <img src="{{'https://crm.kinhmatkool.com/uploads/picture/product/small/' . $pro_image->pri_name}}"
                        alt="">
                </div>
                @endforeach
            </div>

            @endif
            <!-- end slider column -->

            <div class="detail__pro-info col-lg-6">
                <div class="detail__pro-name">{{$pro_detail[0]->pro_name}}</div>
                <input class="name__pro-hidden" name="name_pro_hidden" type="hidden"
                    data-name-pro="{{$pro_detail[0]->pro_name}}">
                <div class="detail__pro-sku">Mã sản phẩm: {{$pro_detail[0]->prv_sku}}</div>
                <input class="detail__pro-hidden" name="detail__pro-hidden" type="hidden"
                    data-pro-id="{{$pro_detail[0]->prv_product_id}}">
                <input class="detail__prv-hidden" name="detail__prv-hidden" type="hidden"
                    data-prv-id="{{$pro_detail[0]->prv_id}}">
                    @if(empty($pro_image_record[0]->pri_name))
                     <input class="detail__image-hidden" name="detail__image-hidden" type="hidden">
                     @else
                <input class="detail__image-hidden" name="detail__image-hidden" type="hidden"
                    data-image-pro="{{'https://crm.kinhmatkool.com/uploads/picture/product/small/' . $pro_image_record[0]->pri_name}}">
                    @endif
                <input class="detail__brand-hidden" name="detail__brand-hidden" type="hidden"
                    data-brand-pro="{{$pro_detail[0]->bra_name}}">
                <div class="detail__pro-color-its">Mã màu: {{ucwords($pro_detail[0]->prv_name)}}</div>
                <input class="name__color-hidden" name="name_color_hidden" type="hidden"
                    data-name-color="{{ucwords($pro_detail[0]->prv_name)}}">
                <div class="detail__pro-color">
                    <div class="detail__pro-color-title">Màu sắc:</div>
                        <div class="group-color-name">
                    @foreach($prv_name as $prv_name_id)
                    @php
                    $prv_id_color = $prv_name_id -> prv_id;
                    $prv_name_color = $prv_name_id -> prv_name;
                    @endphp
                    @if($prv_id_color == $_GET['variant_id'])
                    @continue;
                    @else
                    @php
                    $prv_slug_url = $prv_slug[0] -> pro_slug;
                    $prv_pro_id_slug = $prv_slug[0] -> pro_id;
                    $url_prv = route('detail_product', ['slug' => $prv_slug_url, 'id' => $prv_pro_id_slug]); @endphp
                             <a href="{{$url_prv ."?variant_id=".$prv_id_color}}" class="detail__product-href">
                            <div class="detail__pro-color-item-frist">
                                <div class="detail__pro-color-logo" style="background-color: #4682B4"></div>
                                <div class="detail__pro-color-name">{{ucwords($prv_name_color)}}</div>
                            </div>
                        </a>

                    @endif
                    @endforeach
                    </div>
                </div>
                <div class="detail__pro-qty">
                    <div class="qty__name">Số lượng</div>
                    <div class="qty__content">
                        <div class="qty__minus"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                            </svg></div>
                        <input class="qty__number" name="qty_product" value="1" type="text" step="1" max="5" min="1"
                            style="height: 38px">
                        <div class="qty__plus"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg></div>
                    </div>
                    @if (!empty($promotion_type))
                        @php 
                            $promo_discount = $promotion_type[0]->prm_discount_value;
                            $price_sale = $pro_detail[0]->prv_price_sale - ($pro_detail[0]->prv_price_sale * ($promo_discount/ 100))
                        @endphp
                    <input type="hidden" value="{{$price_sale}}" class="price_sale">
                    <div class="group__price-detail">
                        <div class="detail__pro-price-after">Giá Gốc:  {{currency_format($pro_detail[0]->prv_price_sale)}}</div>
                        <div class="detail__pro-price">Giá Sale:  {{currency_format($price_sale)}}</div>
                    </div>
                    @else
                        <input type="hidden" value="0" class="price_sale">
                        <div class="detail__pro-price">Giá: {{currency_format($pro_detail[0]->prv_price_sale)}}</div>
                    @endif

                    <input class="detail__pro-price-hidden" name="pro_price_hidden" type="hidden"
                        data-price-pro="{{$pro_detail[0]->prv_price_sale}}">
                </div>
                <div class="group-btn-detail-pro">
                    <button class=" btn__detail-pro add__to-cart color-white" type="submit"><a href="">          
                        <svg>
                            <rect x="0" y="0" fill="none" width="100%" height="100%"/>
                         </svg>THÊM VÀO GIỎ HÀNG</a></button>
                    <button class=" btn__detail-pro buy__now" type="submit"><a href="">
                        <svg>
                            <rect x="0" y="0" fill="none" width="100%" height="100%"/>
                         </svg>
                        MUA NGAY</a></button>
                </div>
        </div>
    </div>

        <div class="detail__pro-content">
            <div class="detail__pro-content-title">MÔ TẢ CHI TIẾT</div>
            <div class="detail__pro-content-text">
                {!! $content_pro[0]->prc_content !!}

            </div>

            <div class="glasses__size">
                <div class="glasses__size-title">KÍCH THƯỚC GỌNG KÍNH</div>
                <div class="">
                    <div class="glasses__size-items">
                        <div><img src="/assets/image/product/chieu_ngang_1.png" alt="" class="size-img"></div>
                        <div class="glasses__size-item-title">Chiều ngang</div>
                        <div class="glasses__size-item-text">139 mm</div>
                    </div>
                    <div class="glasses__size-items">
                        <div><img src="/assets/image/product/chieu_ngang.png" alt="" class="size-img"></div>
                        <div class="glasses__size-item-title">Chiều dài càng kính</div>
                        <div class="glasses__size-item-text">137 mm</div>
                    </div>
                    <div class="glasses__size-items">
                        <div><img src="/assets/image/product/do_rong.png" alt="" class="size-img"></div>
                        <div class="glasses__size-item-title">Độ rộng tròng</div>
                        <div class="glasses__size-item-text">55 mm</div>
                    </div>
                    <div class="glasses__size-items">
                        <div><img src="/assets/image/product/do_cao.png" alt="" class="size-img"></div>
                        <div class="glasses__size-item-title">Độ cao tròng</div>
                        <div class="glasses__size-item-text">39 mm</div>
                    </div>
                    <div class="glasses__size-items">
                        <div><img src="/assets/image/product/cau_mui.png" alt="" class="size-img"></div>
                        <div class="glasses__size-item-title">Cầu mũi</div>
                        <div class="glasses__size-item-text">14 mm</div>
                    </div>
                </div>

            </div>





        </div>
    </div>
</div>


<div class="u__need">
    CÓ THỂ BẠN QUAN TÂM
</div>
<div class="owl-carousel owl-theme owl__u-need" data-dot="1">
    @foreach ($pro_info_final as $pro_info)
    @php $pro_info_clone = $pro_info;
    $img_detail_main = reset($pro_info['img_pro']);
    $img_detail_clone = array_slice($pro_info_clone['img_pro'],1,1);
    $img_detail_next = reset($img_detail_clone);
    @endphp
    <?php $url = route('detail_product', ['slug' => $pro_info['pro_prv_id']['pro_slug'], 'id' => $pro_info['pro_prv_id']['pro_id']]); ?>
    @if(empty($pro_info['img_pro']))
    <div class="item slider__item-u-need">
        @php $pro_id_slider = $pro_info['prv_id'][0];@endphp
        <a href="{{$url ."?variant_id=".$pro_id_slider->prv_id}}"><img
                src="https://via.placeholder.com/305x305.png?text=Kinhmatkool.com" alt=""></a>
        <!--  -->
        <div class="owl-carousel owl-theme owl__u-need-small-detail">
            <div class="item slider__item-u-need-small-detail">
                <a href="">
                    <img src="https://via.placeholder.com/42x42.png?text=Kinhmatkool.com" alt="">
                </a>
            </div>
        </div>
        <div class="small__slider-name">{{$pro_info['pro_prv_id']['pro_name']}}</div>
        <div class="small__slider-price">{{currency_format($pro_info['pro_prv_id']['pro_price'])}}</div>
        <!--  -->
    </div>
    @elseif (empty($pro_info['img_prv']))
    <div class="item slider__item-u-need">
        @php $pro_id_slider = $pro_info['prv_id'][0];@endphp
        <a href="{{$url ."?variant_id=".$pro_id_slider->prv_id}}"><img
                src="https://via.placeholder.com/305x305.png?text=Kinhmatkool.com" alt=""></a>
        <!--  -->
        <div class="owl-carousel owl-theme owl__u-need-small-detail">
            <div class="item slider__item-u-need-small-detail">
                <a href="">
                    <img src="https://via.placeholder.com/42x42.png?text=Kinhmatkool.com" alt="">
                </a>
            </div>
        </div>
        <div class="small__slider-name">{{$pro_info['pro_prv_id']['pro_name']}}</div>
        <div class="small__slider-price">{{currency_format($pro_info['pro_prv_id']['pro_price'])}}</div>
        <!--  -->
    </div>
    @else
    <div class="item slider__item-u-need">
        @php $pro_id_slider = $pro_info['prv_id'][0];@endphp
        @php $pro_info_clone = $pro_info;
        $img_detail_main = reset($pro_info['img_pro']);
        $img_detail_clone = array_slice($pro_info_clone['img_pro'],1,1);
        $img_detail_next = reset($img_detail_clone);
        @endphp
        <a href="{{$url ."?variant_id=".$pro_id_slider->prv_id}}" style="position:relative;">
            <img class="slider__a-u-need"
                src="{{'https://crm.kinhmatkool.com/uploads/picture/product/medium/'.$img_detail_main}}" alt="">
            <img class="hover-image"
                src="{{asset('https://crm.kinhmatkool.com/uploads/picture/product/medium/'.$img_detail_main)}}" />
            <img class="second-image"
                src="{{'https://crm.kinhmatkool.com/uploads/picture/product/medium/' . $img_detail_next}}" />
            <div class="count__color">Màu Sắc: {{"0".count($pro_info['prv_id'])}}</div>
        </a>

        <!--  -->
        <div class="owl-carousel owl-theme owl__u-need-small-detail">
            @foreach ($pro_info['prv_id'] as $index => $prv_id)
            @php
            $prv_img = $pro_info['img_prv'][$index] ?? null;
            @endphp
            @if ($prv_img)
            <div class="item slider__item-u-need-small-detail">
                <a href="{{ $url ."?variant_id=".$prv_id->prv_id }}" class="product_variant__item"
                    data-image="{{'https://crm.kinhmatkool.com/uploads/picture/product/medium/' . $prv_img[0] }}">
                    <img src="{{'https://crm.kinhmatkool.com/uploads/picture/product/smalllest/'. $prv_img[0] }}" alt="">
                </a>
            </div>
            @endif
            @endforeach
        </div>
        <div class="small__slider-name">{{$pro_info['pro_prv_id']['pro_name']}}</div>
        <div class="small__slider-price">{{currency_format($pro_info['pro_prv_id']['pro_price'])}}</div>
        <!--  -->
    </div>
    @endif
    @endforeach
    <!--  -->
</div>

</body>


@endsection
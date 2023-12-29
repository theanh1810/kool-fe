@extends('layouts.index')

@section('content')
<div class="poster-and-part-title">
    <div class="poster-holder">
        <img class="poster" src="{{asset("image/xmas.png")}}" alt="HomePoster" />
        {{-- <img class="poster" src="{{ 'https://crm.kinhmatkool.com/uploads/picture/banner/'. $banner[BANNER_HOME_1]->ban_image}}" alt="HomePoster" /> --}}
    </div>
    <div class="part-title-holder">
        <p class="part-title">
            Muốn tìm kính mắt chất từ trong ra ngoài - <span style="font-family: Averta-Bold">ĐẾN NGAY KÍNH MẮT KOOL</span>
        </p>
    </div>
</div>

<div class="main-contents">
    <div class="part">
        <div class="best-seller">
            <div class="row best-seller-title">
                <div class="col-4">
                    <hr class="best-seller-title-decor" />
                </div>
                <div class="col best-seller-title-text">SẢN PHẨM BÁN CHẠY</div>
                <div class="col-4">
                    <hr class="best-seller-title-decor" />
                </div>
            </div>
            <div class="row best-seller-products">
                    <div class="col-sm-6 best-seller-item hvr-underline-reveal">
                        <a href="{{url("gong-kinh-ci1")}}">
                        <div class="best-seller-item-img-holder">
                            <img src="{{asset("image/product_type/type2.png")}}" class="best-seller-item-img" alt="" />
                        </div>
                        <p class="title__best-seller">GỌNG KÍNH</p>
                </a>
            </div>
            <div class="col-sm-6 best-seller-item hvr-underline-reveal">
                <a href="{{url("gong-kinh-ci1")}}">
                    <div class="best-seller-item-img-holder">
                        <img src="{{asset("image/product_type/type2.png")}}" class="best-seller-item-img" alt="" />
                    </div>
                    <p class="title__best-seller">TRÒNG KÍNH</p>
                </a>
            </div>
            <div class="col-sm-6 best-seller-item hvr-underline-reveal">
                <a href="{{url("kinh-ram-ci7")}}">
                    <div class="best-seller-item-img-holder">
                        <img src="{{asset("image/product_type/type3.png")}}" class="best-seller-item-img" alt="" />
                    </div>
                    <p class="title__best-seller">KÍNH RÂM</p>
                </a>
            </div>
            <div class="col-sm-6 best-seller-item hvr-underline-reveal">
                <a href="{{url("gong-kinh-ci1")}}">
                    <div class="best-seller-item-img-holder">
                        <img src="{{asset("image/product_type/type4.png")}}" class="best-seller-item-img" alt="" />
                    </div>
                    <p class="title__best-seller">PHỤ KIỆN</p>
                </a>
            </div>
        </div>
        <div class="flash-sale row">
            <div class="d-flex align-items-center col">
                <div class="flash-sale-img-holder">
                    <img src="{{asset("image/flash-sale.png")}}" class="flash-sale-img" alt="" />
                    <span class="flash-sale--title">FLASHSALE</span>
                </div>
                <div class="align-items-center sale--happening">- Đang diễn ra</div>
                <div class="timer__container">

                    <div id="timer--countdown">
                        <ul class="mb-0">
                            <li class="timer__item--holder " id="timer-days"><span class="timer__item" id="days">
                            <li class="timer__item--holder " id="timer-hours"><span class="timer__item" id="hours">
                            <li class="timer__item--holder " id="timer-minutes"><span class="timer__item" id="minutes">
                            <li class="timer__item--holder " id="timer-seconds"><span class="timer__item" id="seconds">
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-3 d-flex align-items-center px-0 sale--watch-parent">
                <a class="sale--watch-all">Xem tất cả >>></a>
            </div>
        </div>
        <div class="position-relative">
            <div class="owl-carousel owl-carousel-sale-home owl-theme">
                @foreach ($promotions_info["promotions_1"]["prm_product"] as $pro_sale)
                @if(empty($pro_sale["pro_info"]) || empty($pro_sale["pro_info"][0]))
                @continue
                @endif
                {{-- @dd($pro_sale["pro_info"][0]->prv_id) --}}
                @php $url = route('detail_product', ['slug' =>$pro_sale["pro_info"][0]->pro_slug, 'id' =>
                $pro_sale["pro_info"][0]->prv_product_id]); @endphp
                <a class="link-pro-sale" href="{{$url ."?variant_id=".$pro_sale["pro_info"][0]->prv_id}}">
                    <div class="item flashsale--item">
                        <div class="sale-product-img-holder">
                            <img class="sale-product-img"
                                src="{{ 'https://crm.kinhmatkool.com/uploads/picture/product/medium/'. $pro_sale["pro_image"][0]->pri_name}}"
                                alt="" />
                            <img class="second-image" src="{{'https://crm.kinhmatkool.com/uploads/picture/product/medium/' . $pro_sale["pro_image"][1]->pri_name}}" />
                            <div class="sale-product__percentage">
                                <img src="../../assets/image/flashsale/flag.svg" alt="" />
                                <div class="sale-product__percentage--text">
                                    {{$promotions_info["promotions_1"]['prm_discount_value']}}% OFF</div>
                            </div>
                        </div>
                        <div class="sale-product-infor pt-2 position-relative">
                            <div class="text-center  text-white brand__name-sale">{{$pro_sale["pro_info"][0]->bra_name}}</div>
                            <p class="text-white pro__name-sale" style="text-align: justify; letter-spacing:-0.5px">
                                {{$pro_sale["pro_info"][0]->pro_name}}
                            </p>
                            <div class="d-flex justify-content-center text-ceter">
                                <p class="text-decoration-line-through d-flex align-items-center text-white mb-0 me-3 price__after-sale-home" style="font-family: Averta-Thin">
                                    {{currency_format($pro_sale["pro_info"][0]->prv_price_sale)}}
                                </p>
                                <p class="d-flex align-items-lef text-white mb-0 price__before-sale-home">
                                    @php $price_sale = $pro_sale["pro_info"][0]->prv_price_sale -
                                    $pro_sale["pro_info"][0]->prv_price_sale *
                                    ($promotions_info["promotions_1"]['prm_discount_value']/100);@endphp
                                    {{currency_format($price_sale)}}
                                </p>
                            </div>
                            <div class="w-100" style="margin-top: 10px">
                                <img src="../../assets/image/flashsale/sold.svg" class="sale-status" alt="" />
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
    </div>
    <div class="mx-2 mt-5">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/0yY0EpkoZxU?autoplay=1&mute=1"
            allowfullscreen></iframe>
    </div>
</div>
</div>
<div class="part-title-holder">
    <p class="part-title">VÌ SAO LẠI CHỌN KOOL EYEWEAR</p>
</div>
<div class="part why-choose-kool">
    <div class="row">
        <div class="self-intro-box hvr-grow-shadow">
            <div class="self-intro-img-holder">
                <img class="self-intro-img"src="{{asset("image/self-intro/secure-shield.png")}}"
                    alt="" />
            </div>
            <p class="text-center self-intro-title ">
                CAM KẾT CHẤT LƯỢNG HÀNG ĐẦU
            </p>
            <p class="m-0 self-intro-content" >
                Phân phối các tròng kính chính hãng đến từ các thương hiệu hàng
                đầu,...
            </p>
        </div>
        <div class="self-intro-box hvr-grow-shadow">
            <div class="self-intro-img-holder">
                <img class="self-intro-img" src="{{asset("image/self-intro/check.png")}}"
                    alt="" />
            </div>
            <p class="text-center self-intro-title ">CƠ SỞ VẬT CHẤT HIỆN ĐẠI</p>
            <p class="m-0 self-intro-content" >
                Kool EyeWear sở hữu các thiết bị đo khám, cắt lắp mặt tiên tiến
                bậc nhất
            </p>
        </div>
        <div class="self-intro-box hvr-grow-shadow">
            <div class="self-intro-img-holder">
                <img class="self-intro-img"  src="{{asset("image/self-intro/glasses.png")}}" alt="" />
            </div>
            <p class="text-center self-intro-title">MẪU MÃ ĐA DẠNG</p>
            <p class="m-0 self-intro-content">
                Luôn cập nhật xu hướng mới nhất đáp ứng yêu cầu của khách hàng ở
                mọi giới tính, lứa tuổi
            </p>
        </div>
        <div class="self-intro-box hvr-grow-shadow">
            <div class="self-intro-img-holder">
                <img class="self-intro-img"  src="{{asset("image/self-intro/money-bag.png")}}" alt="" />
            </div>
            <p class="text-center self-intro-title">GIÁ CẢ HỢP LÝ</p>
            <p class="m-0 self-intro-content">
                Chi phí tương ứng với chất lượng, nhiều chương trình ưu đãi và chế
                dộ bảo hành
            </p>
        </div>
    </div>
    <div class="partner-box">
        <div class="text-center partner-list-title">ĐỐI TÁC HÀNG ĐẦU</div>
                <div class="owl-theme owl-carousel owl-loaded owl-drag" id="brand">
                            @foreach ($brand as $value)
                             <div class="item-brand item hvr-bounce-out">
                                            @if (!empty($value->bra_logo))
                                                <img src="{{asset("/image/main/".$value->bra_logo)}}" class="partner-img" />
                                            @else
                                                <img src="{{"https://via.placeholder.com/218x100.png?text=" .$value->bra_name}}" class="partner-img" />
                                            @endif
                             </div>
                            @endforeach
                </div>
    </div>
</div>
<div class="part-title-holder">
    <p class="part-title">DANH MỤC SẢN PHẨM</p>
</div>
<div class="part category__pro-home">
    <div class="row">
        <div class="category-item">
            <a href="{{url("gong-kinh-ci1")}}">
                <div class="category-img-holder">
                    <img class="category-img" src="{{asset("image/category/category1.png")}}" alt="" />
                </div>
                <p class="category-item-name">Gọng kính cận</p>
                <button id="myoptic-glasses" class="watch-more-btn">Xem thêm</button>
            </a>
        </div>
        <div class="category-item">
            <a href="{{url("kinh-ram-ci7")}}">
                <div class="category-img-holder">
                    <img class="category-img" src="{{asset("image/category/category2.png")}}" alt="" />
                </div>
                <p class="category-item-name">Gọng kính râm</p>
                <button id="sun-glasses" class="watch-more-btn">Xem thêm</button>
            </a>
        </div>
        <div class="category-item">
            <a href="">
                <div class="category-img-holder">
                    <img class="category-img" src="{{asset("image/category/category3.png")}}" alt="" />
                </div>
                <p class="category-item-name">Tròng kính</p>
                <button id="lenses" class="watch-more-btn">Xem thêm</button>
            </a>
        </div>
        <div class="category-item">
            <a href="">
                <div class="category-img-holder">
                    <img class="category-img" src="{{asset("image/category/category4.png")}}" alt="" />
                </div>
                <p class="category-item-name">Phụ kiện</p>
                <button id="accessory" class="watch-more-btn">Xem thêm</button>
        </div>
        </a>
    </div>
</div>

<div class="part-title-holder">
    <p class="part-title">TIN TỨC - GÓC KOOL</p>
</div>
<div class="part">
    <div class="row news-con">
        <div class="news-item-left news-item--pc ">
            <div>
                <div class="img-new-left" style="position: relative">
                    <img class="" src="{{asset("/image/main/".$post[0]->pos_image)}}" alt="" />                    
                    <div class="news-hot">Tin tức nổi bật</div>
                </div>
            </div>
            <p class="fw-bold title-blog-home">{{$post[0]->pos_title}}</p>
            <p class="pos-content-home">
                {{$post[0]->pos_excerpt}}
            </p>
            <div class=" text-end">
                <a href="{{route('blog-detail', ['slug' => $post[0]->pos_slug , 'id' => $post[0]->pos_id])}}"><button id="news" class="watch-more-btn">Xem thêm</button></a>
            </div>
        </div>
        <div class="px-0 news-right">
            <div class="news-item-right">
                <div class="col px-0">
                    <div class="img-new-right"><img class="" src="{{asset("/image/main/".$post[1]->pos_image)}}" alt="" /></div>

                </div>
                <div class="col">
                    <p class="fw-bold title-blog-home-right">
                        {{$post[1]->pos_title}}
                    </p>
                    <p class="pos_excerpt">
                        {{$post[1]->pos_excerpt}}
                    </p>
                    <div class=" text-end">
                        <a href="{{route('blog-detail', ['slug' => $post[1]->pos_slug , 'id' => $post[1]->pos_id])}}"><button id="news" class="watch-more-btn disable-btn">Xem thêm</button></a>
                    </div>
                </div>
            </div>
            <div class="news-item-right" style="margin-top:20px">
                <div class="col px-0">
                    <div class="img-new-right" ><img class="" src="{{asset("/image/main/".$post[2]->pos_image)}}" alt="" /></div>
                </div>
                <div class="col">
                    <p class="fw-bold title-blog-home-right">
                        {{$post[2]->pos_title}}
                    </p>
                    <p class="pos_excerpt">
                        {{$post[2]->pos_excerpt}}
                    </p>
                    <div class=" text-end">
                        <a href="{{route('blog-detail', ['slug' => $post[2]->pos_slug , 'id' => $post[2]->pos_id])}}"><button id="news" class="watch-more-btn disable-btn">Xem thêm</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="part-title-holder">
    <p class="part-title">CHÍNH SÁCH BẢO HÀNH</p>
</div>
<div class="part">
    <div class="row warranty-container">
        <div class="text-center warranty-item hvr-ripple-in">
            <div class="warranty-img-holder">
                <img class="warranty-img" src="{{asset("image/warranty/warranty1.svg")}}" alt="" />
            </div>
            <div class="warranty-description">
                <p class="mb-1 text-white fw-bold ">VẬN CHUYỂN</p>
                <span class="text-white warranty-detail">Miễn phí cho mọi đơn hàng trên 250k</span>
            </div>
        </div>
        <div class="text-center warranty-item hvr-ripple-in">
            <div class="warranty-img-holder">
                <img class="warranty-img" src="{{asset("image/warranty/warranty2.svg")}}" alt="" />
            </div>
            <div class="warranty-description">
                <p class="mb-1 text-white fw-bold">AN TOÀN</p>
                <span class="text-white warranty-detail">Bảo hành 3 tháng với gọng kính</span>
            </div>
        </div>
        <div class="text-center warranty-item hvr-ripple-in">
            <div class="warranty-img-holder">
                <img class="warranty-img" src="{{asset("image/warranty/warranty3.svg")}}" alt="" />
            </div>
            <div class="warranty-description">
                <p class="mb-1 text-white fw-bold ">TIẾT KIỆM</p>
                <span class="text-white warranty-detail">Giảm 50% thay thế gọng kính trong 6 tháng</span>
            </div>
        </div>
        <div class="text-center warranty-item hvr-ripple-in">
            <div class="warranty-img-holder">
                <img class="warranty-img" src="{{asset("image/warranty/warranty4.svg")}}" alt="" />
            </div>
            <div class="warranty-description">
                <p class="mb-1 text-white fw-bold">ĐỔI TRẢ</p>
                <span class="text-white warranty-detail">30 ngày đổi trả không lý do</span>
            </div>
        </div>
    </div>
</div>
<div class="map row map--pc">
    <div class="map__img--holder col-lg-7">
        <iframe class="map_address__iframe"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.253345179331!2d105.8036168!3d21.0225467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abb37b2ca533%3A0x891ad106a8ee6306!2zS8OtbmggbeG6r3QgS29vbA!5e0!3m2!1svi!2s!4v1699435464682!5m2!1svi!2s"
            style="width:100%;height:400px;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="address col-lg-5">
        <p class="address__title">CỬA HÀNG GẦN BẠN</p>
        <p class="address__body">
            Chúng tôi sở hữu 12 cửa hàng cung cấp cho bạn mẫu kính
            tốt nhất
        </p>
        <div class="address__body-bot">
            <div><span><a href="" class="hvr-underline-from-left">Cầu Giấy </a></span><span class=""><a class="hvr-underline-from-left" href=""> | Ba Đình </a></span><span class=""><a class="hvr-underline-from-left" href=""> | Thanh Xuân </a> </span><span class=""><a class="hvr-underline-from-left" href="">| Hoàn Kiếm </a></span></div>
            <div><span class=""><a class="hvr-underline-from-left" href="">Nam Từ Liêm </a></span><span class=""><a class="hvr-underline-from-left" href=""> | Tây Hồ </a></span><span class=""><a class="hvr-underline-from-left" href=""> | Hoàng Mai </a></span></div>
            <div><span class=""><a class="hvr-underline-from-left" href="">Hà Đông </a></span><span class=""><a class="hvr-underline-from-left" href=""> | Sóc Sơn </a></span><span class=""><a class="hvr-underline-from-left" href=""> | Ba Vì </a></span></div>
            <div><span class=""><a class="hvr-underline-from-left" href="">Bắc Từ Liêm </a></span><span class=""> <a class="hvr-underline-from-left" href="">| Long Biên </a> </span><span class=""><a class="hvr-underline-from-left" href="">| Đông Anh </a></span></div>
        </div>
        <button id="address-btn" class="watch-more-btn">Xem thêm</button>
    </div>

</div>
<div class="map col map--mobile">
    <div class="map__img--holder row">
        <iframe class="map_address__iframe"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d931.0662668080291!2d105.80250642849738!3d21.02207745062816!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab5d18605a45%3A0x567dcfc0983bcef4!2zMzAgTmcuIDE1NyBQLiBDaMO5YSBMw6FuZywgTMOhbmcgVGjGsOG7o25nLCDEkOG7kW5nIMSQYSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1687764357335!5m2!1svi!2s"
            style="width:100%;height:400px;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="address row">
        <p class="address__title">CỬA HÀNG GẦN BẠN</p>
        <p class="address__body">
            Chúng tôi sở hữu 12 cửa hàng cung cấp cho bạn mẫu kính
            tốt nhất
        </p>
        <div class="address__body-bot">
            <div><span><a href="" class="hvr-underline-from-left">Cầu Giấy</a></span><span class=""><a class="hvr-underline-from-left" href=""> | Ba Đình</a></span><span class=""><a class="hvr-underline-from-left" href=""> | Thanh Xuân</a> </span><span class=""><a class="hvr-underline-from-left" href="">| Hoàn Kiếm</a></span></div>
            <div><span class=""><a class="hvr-underline-from-left" href="">Nam Từ Liêm</a></span><span class=""><a class="hvr-underline-from-left" href=""> | Tây Hồ</a></span><span class=""><a class="hvr-underline-from-left" href=""> | Hoàng Mai</a></span></div>
            <div><span class=""><a class="hvr-underline-from-left" href="">Hà Đông</a></span><span class=""><a class="hvr-underline-from-left" href=""> | Sóc Sơn</a></span><span class=""><a class="hvr-underline-from-left" href=""> | Ba Vì</a></span></div>
            <div><span class=""><a class="hvr-underline-from-left" href="">Bắc Từ Liêm</a></span><span class=""> <a class="hvr-underline-from-left" href="">| Long Biên</a> </span><span class=""><a class="hvr-underline-from-left" href="">| Đông Anh</a></span></div>
        </div>
        <div>
            <button id="address-btn" class="watch-more-btn">Xem thêm</button>
        </div>
    </div>

</div>
<script>
$('.owl-carousel-sale-home').owlCarousel({
    loop: true,
    nav: true,
    dots: false,
    responsive: {
        0: {
            items: 1
        },
        450: {
            items: 2
        },
        1000: {
            items: 4
        }
    }
})
</script>
<style>

</style>


@endsection
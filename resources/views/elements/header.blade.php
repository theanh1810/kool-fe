
<header class="position-relative">

    <div id="navbar-mobile" class="navbar__holder--mobile" > 
        <ul class="ul-nav" style="">
            <li><a href="{{url("/")}}">Home</a></li>
            <li><a href="{{url('about-us')}}">Về chúng tôi</a></li>
            <li>
                <a class="product__nav-hover" href="">Sản Phẩm</a>
                <button class="nav__dropdown__icon--mobile">
                    <i class="bi bi-chevron-down show"></i>
                </button>
            </li>
            <ul id="nav__dropdown--mobile" class="hide">
                <li>
                    <a href="{{url('gong-kinh-ci1')}}">
                        <div class="mb-3">Gọng Kính</div>
                    </a>
                    <ul class="dropdown-glasses">
                        <li class="mb-3"><a href="{{url('gong-kinh-unisex-ci4')}}">Gọng Kính Unisex</a></li>
                        <li class="mb-3"><a href="{{url('gong-kinh-nam-ci2')}}">Gọng Kính Nam</a></li>
                        <li class="mb-3"><a href="{{url('gong-kinh-nu-ci3')}}">Gọng Kính Nữ</a></li>
                        <li class="mb-3"><a href="{{url('gong-kinh-tre-em-ci5')}}">Gọng Kính Trẻ Em</a></li>
                    </ul>
                </li>
                <li>
                <div class="mb-3">Tròng Kính</div>
                    <ul class="dropdown-lens">
                        <li class="mb-3"><a href="{{url('chemi-ci-10')}}">Tròng Kính Chemi</a></li>
                        <li class="mb-3"><a href="{{url('essilor-ci-11')}}">Tròng Kính Essilor</a></li>
                        <li class="mb-3"><a href="{{url('zeiss-ci-12')}}">Tròng Kính Zeiss</a></li>
                    </ul>
                </li>
                <li>
                    <div class="mb-3">Kính Thời Trang</div>
                    <ul>
                        <li class="mb-3"><a href="{{url('kinh-ram-ci7')}}">Kính Mát, Kính Râm</a></li>
                    </ul>
                    <div class="mb-3">Phụ Kiện</div>
                    <ul>
                        <li class="mb-3 Accessory"><a href="">Phụ Kiện Kính Mắt</a></li>
                    </ul>
                </li>
            </ul>
            <li><a href="{{url("product-sale/ci1")}}">Ưu đãi</a></li>
            <li><a href="{{url('blog/tin-tuc-ci5')}}">Góc của Kool</a></li>
            <li>Tra cứu</li>
            <ul id="nav__dropdown--mobile" class="hide">
                <div class="mb-3">Tra cứu</div>
                    <ul>
                        <li class="mb-3 Accessory"><a href="{{url('search-order')}}">Tra cứu đơn</a></li>
                        <li class="mb-3 Accessory"><a href="{{url('search-warranty')}}">Tra cứu bảo hành</a></li>
                    </ul>
                </li>
            </ul>
        </ul>
    </div>
    <div class="row header-infor">
        <div class="col logo-box">
            <button id="nav-hamburger" class="me-4 open">
                <i class="fa fa-bars"></i>
            </button>
            <a href="{{url('/')}}" class="logo_link"><img href="" src="{{asset("image/logo.svg")}}" class="logo"></a>
        </div>
        <div class="col"></div>
        <div class="col search-and-cart">
                <div class="search-con" style="position: relative">
                    <input class="search-box" id="search-form" placeholder="Tìm kính phù hợp">
                    <span class="position-absolute search-group">
                        <i class="bi bi-search search--icon"></i>
                    </span>
                </div>
                <a href="{{url('purchase')}}" style="position: relative;"><img href="" src="{{asset("image/shopping-cart.png")}}" class="cart" >
                <div class="count__pro-cart">{{Cart::count()}}</div>
                </a>
               

        </div>
    </div>



    <div class="navbar-holder">
        <ul class="navbar">
            <li class="navbar-item-holder first"><a href="{{url('/');}}" class="navbar-item">Home</a>
            </li>

            <li class="navbar-item-holder"><a href="{{url('about-us');}}" class="navbar-item">Về chúng tôi</a>
            </li>

            <li class="navbar-item-holder position-relative navbar__item--product nav-product-hover">
                <a href="{{url('gong-kinh-ci1');}}" class="navbar-item ">Sản phẩm</a>
                <div class="position-absolute nav__dropdown--product nav-dropdown-hided">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="nav__dropdown--product--title">Gọng kính</div>
                            <ul class="ps-0">
                                <li class="nav__dropdown--product--item"><a
                                        href="{{url("gong-kinh-unisex-ci4")}}">Gọng
                                        Kính Unisex</a></li>
                                <li class="nav__dropdown--product--item"><a
                                        href="{{url("gong-kinh-nam-ci2")}}">Gọng
                                        Kính Nam </a></li>
                                <li class="nav__dropdown--product--item"><a
                                        href="{{url("gong-kinh-nu-ci3")}}">Gọng
                                        Kính Nữ</a></li>
                                <li class="nav__dropdown--product--item"><a
                                        href="{{url("gong-kinh-tre-em-ci5")}}">Gọng
                                        Kính Trẻ Em</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <div class="nav__dropdown--product--title">Tròng Kính</div>
                            <ul class="ps-0">
                               <li class="nav__dropdown--product--item"><a
                                        href="{{url("chemi-ci10")}}">Tròng Kính CHEMI</a></li>
                                <li class="nav__dropdown--product--item"><a
                                        href="{{url("essilor-ci11")}}">Tròng Kính ESSILOR</a></li>
                                <li class="nav__dropdown--product--item"><a
                                        href="{{url("'zeiss-ci12")}}">Tròng Kính ZEISS</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <div class="nav__dropdown--product--title">Kính thời trang</div>
                            <ul class="ps-0">
                                <li class="nav__dropdown--product--item"><a href="{{url("kinh-ram-ci7")}}">Kính Mát Kính Râm</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <div class="nav__dropdown--product--title">Phụ Kiện</div>
                            <ul class="ps-0">
                                <li class="nav__dropdown--product--item"><a href="">Phụ Kiện Kính Mắt</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>

            <li class="navbar-item-holder sale "><a href="{{url("product-sale/ci1")}}" class="navbar-item">Ưu đãi</a>

            </li>
            <li class="navbar-item-holder"><a href="{{url('blog/tin-tuc-ci5');}}" class="navbar-item">Góc của Kool</a>

            </li>

            <li class="navbar-item-holder position-relative navbar__item--product nav-product-hover last">
                <a href="{{url('gong-kinh-ci1');}}" class="navbar-item ">Tra cứu</a>
                <div class="position-absolute nav__dropdown--product nav-dropdown-hided search_order">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="nav__dropdown--product--title">Tra cứu  </div>
                            <ul class="ps-0">
                                <li class="nav__dropdown--product--item"><a
                                        href="{{url('search-order')}}">Tra cứu đơn</a></li>
                                <li class="nav__dropdown--product--item"><a
                                        href="{{url('search-warranty')}}">Tra cứu bảo hành</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <script>
        $(".nav__dropdown__icon--mobile").on("click", function(){
            $(".nav__dropdown__icon--mobile>i").toggleClass("bi-chevron-down bi-chevron-up");
            if($("#nav__dropdown--mobile").hasClass("hide")){
                $("#nav__dropdown--mobile").removeClass("hide");
                $("#nav__dropdown--mobile").addClass("show");
            }else{
                $("#nav__dropdown--mobile").removeClass("show");
                $("#nav__dropdown--mobile").addClass("hide");
            }

        })

   

    
    </script>
</header>
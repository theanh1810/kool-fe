@extends('layouts.index')

@section("content")
<div class="banner" style="width: 100%">
  <img style="width: 100%"src="{{asset("image/xmas.png")}}" alt="">
</div>
  <div class="about-us">
    <div class="container-f">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
          <div class="top__au">
            <div class="top__au-first row">
              <div class="top__au-left col">
                <div class="container__img-about-us"><img src="{{asset("image/about-us/vision.jpg")}}" alt="" class="img__au-left"></div>
                <div class="content__au-left">
                  <p class="title__au-top">
                    TẦM NHÌN
                  </p>
                  <p class="text__au-top">Không ngừng SÁNG TẠO để nâng cao chất lượng dịch vụ, Kính mắt Kool kỳ vọng sẽ
                    trở thành thương hiệu
                    kính mắt uy tín hàng
                    đầu tại Việt Nam đáp ứng đủ tiêu chí chất lượng và thời trang đối với tất cả đối tượng khách hàng
                  </p>
                </div>
              </div>
              <div class="top__au-right col">
                <div class="container__img-about-us"><img src="{{asset("image/about-us/su-menh.jpg")}}" alt="" class="img__au-left"></div>
                <div class="content__au-right">
                  <p class="title__au-top">
                    SỨ MỆNH
                  </p>
                  <p class="text__au-top">Giúp các khách hàng sở hữu một cặp kính không chỉ bảo vệ đôi mắt an toàn mà
                    còn
                    làm nổi bật gương
                    mặt</p>
                </div>
              </div>
            </div>

            <div class="core__values">GIÁ TRỊ CỐT LÕI</div>
            <div class="logo__top-au ">
              <div class="logo__top-items-first ">
                <div class="logo__top-img"><img src="{{asset("image/about-us/target.png")}}" alt=""></div>
                <p class="logo__top-text">Khách hàng là trọng tâm</p>
              </div>
              <div class="logo__top-items ">
                <div class="logo__top-img"><img src="{{asset("image/about-us/badge.png")}}" alt=""></div>
                <p class="logo__top-text">Chất lượng</p>
              </div>
              <div class="logo__top-items ">
                <div class="logo__top-img"><img src="{{asset("image/about-us/trust.png")}}" alt=""></div>
                <p class="logo__top-text">Tin cậy</p>
              </div>
              <div class="logo__top-items ">
                <div class="logo__top-img"><img src="{{asset("image/about-us/transfer.png")}}" alt=""></div>
                <p class="logo__top-text">Đổi mới</p>
              </div>
              <div class="logo__top-items ">
                <div class="logo__top-img"><img src="{{asset("image/about-us/heart.png")}}" alt=""></div>
                <p class="logo__top-text">Tận Tâm</p>
              </div>
            </div>
          </div>

          <div class="advantage__au">LỢI THẾ CỦA KÍNH MẮT KOOL</div>

          <div class="bottom__au row">
            <div class="bottom__au-items col-md-6 col-12">
              <div class="bottom__au-items-img"  style="background-image: url({{asset("image/about-us/quality.png")}})"></div>
              <div class="content__au-items">
                <div class="logo__bottom-au">
                  <div class="logo__bottom-item"><img src="{{asset("image/self-intro/secure-shield.png")}}" alt=""></div>
                </div>
                <p class="title__bottom-au">CAM KẾT CHẤT LƯỢNG</p>
                <p class="text__bottom-au">Phân phối các tròng kính chính hãng đến từ các thương hiệu hàng đầu Chemi,
                  Esilor, Ziess</p>
              </div>
            </div>
            <div class="bottom__au-items col-md-6 col-12">
              <div class="bottom__au-items-img"  style="background-image: url({{asset("image/about-us/kool3413.jpg")}})"></div>
              <div class="content__au-items">
                <div class="logo__bottom-au">
                  <div class="logo__bottom-item"><img src="{{asset("image/self-intro/check.png")}}" alt=""></div>
                </div>
                <p class="title__bottom-au">CƠ SỞ VẬT CHẤT
                  HIỆN ĐẠI</p>
                <p class="text__bottom-au">Kool Eyewear sở hữu các thiết bị đo khám, cắt lắp mắt tiên tiến bậc nhất tại Việt Nam</p>
              </div>
            </div>
            <div class="bottom__au-items col-md-6 col-12">
              <div class="bottom__au-items-img"  style="background-image: url({{asset("image/about-us/kool3431.jpg")}})"></div>
              <div class="content__au-items">
                <div class="logo__bottom-au">
                  <div class="logo__bottom-item"><img src="{{asset("image/self-intro/glasses.png")}}" alt=""></div>
                </div>
                <p class="title__bottom-au">MẪU MÃ ĐA DẠNG</p>
                <p class="text__bottom-au">Luôn cập nhật xu hướng mới nhất đáp ứng yêu cầu của khách hàng ở mọi giới
                  tính, lứa tuổi</p>
              </div>
            </div>
            <div class="bottom__au-items col-md-6 col-12 ">
              <div class="bottom__au-items-img "  style="background-image: url({{asset("image/about-us/card-pay.jpg")}});"></div>
              <div class="content__au-items">
                <div class="logo__bottom-au">
                  <div class="logo__bottom-item"><img src="{{asset("image/self-intro/money-bag.png")}}" alt=""></div>
                </div>
                <p class="title__bottom-au">GIÁ CẢ HỢP LÝ</p>
                <p class="text__bottom-au">Chi phí tương xứng với chất lượng, nhiều chương trình ưu đãi và chế độ bảo
                  hành</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endsection
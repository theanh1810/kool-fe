@extends('layouts.index')

@section('content')

<div class="banner" style="width: 100%">
  <img style="width: 100%"src="{{asset("image/xmas.png")}}" alt="">
</div>

<div class="breadcrumb"></div>

<div class="container__category-first category_con" style="margin-bottom:30px;">
  <div class="row">
    <div class="col-lg-12 category__container" style="display: flex;  flex-direction: column;">


      <div class="filter__category  col-lg-12">
        <div class="detail__filter">
          <a href="">
            <div class="plus__icon-category"><i class="bi bi-plus"></i></div>
          </a>
          <div class="text__filter-nav">Bộ lọc</div>
        </div>
        <div class="category__glasses">
          <a href="{{url('gong-kinh-nam-ci2');}}" class="category__glasses-items">
            <div>Gọng Kính Nam</div>
          </a>
          <a href="{{url('gong-kinh-nu-ci3');}}" class="category__glasses-items">
            <div>Gọng Kính Nữ</div>
          </a>
          <a href="{{url('gong-kinh-unisex-ci4');}}" class="category__glasses-items">
            <div>Gọng Kính Unisex</div>
          </a>
          {{-- <a href="" class="category__glasses-items">
            <div>Gọng Kính Trẻ Em</div>
          </a>                                       --}}
        </div>
        <div class="order__category">

          @php 
            $sortedProducts = session('sorted_products', []);
          @endphp
          

          <select id="order__category-select" class="form-control" name="order_category_select">
            <option value="" >Sắp xếp theo</option>
            <option value="asc" >Giá tăng dần</option>
            <option value="desc" >Giá giảm dần</option>
            <option value="new " >Mới nhất</option>
          </select>
        <div class="icon__order-category"><i class="bi bi-caret-down-fill"></i></div>
        </div>
      </div>

      <div class="container__category">
        <div class="con-filter">
          <form method="get" class="cate__filter-mb filter-hidden" id="open__filter-id">
            <div class="close-filter-cate">
              <p>Bảng Lọc</p>
              <i class="bi bi-x-square"></i>
            </div>
            <div class="filter__by-format format-close">
              <div class="title__filter-open title__filter-by-format">HÌNH DẠNG</div>
              <div class="filter__btn-format"><i class="bi bi-caret-down-fill"></i></div>
              <div class="filter__group-format">
                <div class="filter__by-format-item">
                  <img class="img__filter-format" src="/assets/image/format-glasses-web/Oval.png" alt="">
                  <input type="hidden" value="252" class="format__input-hidden">
                  <p >Oval</p>
                </div>
                <div class="filter__by-format-item">
                  <img class="img__filter-format" src="/assets/image/format-glasses-web/Tron.png" alt="">
                  <input type="hidden" value="810" class="format__input-hidden">
                  <p >Tròn</p>
                </div>
                <div class="filter__by-format-item">
                  <img class="img__filter-format" src="/assets/image/format-glasses-web/Vuong.png" alt="">
                  <input type="hidden" value="504" class="format__input-hidden">
                  <p >Vuông</p>
                </div>
                <div class="filter__by-format-item">
                  <img class="img__filter-format" src="/assets/image/format-glasses-web/Da-giac.png" alt="">
                  <input type="hidden" value="775" class="format__input-hidden">
                  <p >Lục giác</p>
                </div>
                <div class="filter__by-format-item">
                  <img class="img__filter-format" src="/assets/image/format-glasses-web/Vuong-bo-tron.png" alt="">
                  <input type="hidden" value="917" class="format__input-hidden">
                  <p >Ngũ Giác</p>
                </div>
                <input type="hidden" class="filter__format-value-id" value="8">
              </div>
            </div>
            <div class="filter__by_material material-close">
              <div class="title__filter-open title__filter-by-material">VẬT LIỆU</div>
              <div class="filter__btn-material"><i class="bi bi-caret-down-fill"></i></div>
              <div class="filter__by_material-item" >
                <input type="hidden" value="41" class="material__input-hidden">Nhựa</div>
              <div class="filter__by_material-item" >
                <input type="hidden" value="6" class="material__input-hidden">Nhựa Axetat</div>
              <div class="filter__by_material-item">
                <input type="hidden" value="636" class="material__input-hidden">Kim loại</div>
              <div class="filter__by_material-item" >
                <input type="hidden" value="26" class="material__input-hidden">Nhựa/Kim loại</div>
              <input type="hidden" class="filter__material-value-id" value="9">
            </div>
            <div class="filter__by_brand brand-close">
              <div class="title__filter-open title__filter-by-material">THƯƠNG HIỆU</div>
              <div class="filter__btn-brand"><i class="bi bi-caret-down-fill"></i></div>
              @foreach ($list_brand as $brand)
              <div class="filter__by_brand-item">
                <input type="checkbox" class="brand-checkbox" value="{{$brand->bra_id}}">
                <label for="brand-checkbox">{{$brand->bra_name}}</label>
              </div>
              @endforeach
            </div>
            <div class="filter__by_price">
              <p class="title-price-filter title__filter-open ">Giá</p>
              <input type="text" id="price__filter-input" name="range_price"/>
            </div>
            <button class="btn__filter-cate" type="submit">Lọc sản phẩm</button>
          </form>
        </div>
        <div class="category">
          <div class="title__category-open">Danh sách sản phẩm</div>
          <input type="hidden" value="{{$id}}" class="category_id">
          <input type="hidden" value="" class="order_value_filter">
          <input type="hidden" value="0" class="order_type">
          <input type="hidden" value="0" class="filter_type">
            <input type="hidden" value="" class="material__save-data">
            <input type="hidden" value="" class="format__save-data">
            <input type="hidden" value="" class="brand__save-data">
          <div class="detail__category">

          {{-- <input type="hidden" value="" class="order_filter"> --}}
   @foreach ($pro_info_final as $pro_info)
                @php $url_a_main = $pro_info['prv_id'][0]->prv_id; @endphp
                @php $url_img_main = reset($pro_info['img_pro']) ;
                $pro_info_clone = $pro_info;
                $img_cate_clone = array_slice($pro_info_clone['img_pro'],1,1);
                $img_cate_next = reset($img_cate_clone);
                @endphp
    <?php $url = route('detail_product', ['slug' => $pro_info['pro_prv_id']['pro_slug'], 'id' => $pro_info['pro_prv_id']['pro_id']]); ?>
            <div class="col-lg-4 detail__category-item">
              <div class="group__category-item">
                @if(empty($pro_info['img_prv']))
                <div class="hover-img-location"></div>
               <a href="{{$url ."?variant_id=".$url_a_main}}"><img src="{{'https://crm.kinhmatkool.com/uploads/picture/product/medium/' .$url_img_main}}" alt=""></a>
                <div class="count-color">Màu Sắc:  {{"0".count($pro_info['prv_id'])}}</div>
                <div class="owl-carousel owl-theme owl__category-small" >
                @foreach ($pro_info['prv_id'] as $index => $prv_id)
                  @php
                    $prv_img = $pro_info['img_prv'][$index] ?? null;
                  @endphp
                  @if ($prv_img)
                  <div class="item slider__item-category-small">
                    <a href="" class="product_variant__item" data-image=""><img src="https://via.placeholder.com/42x42.png?text=Kinhmatkool.com" alt=""></a>
                  </div>
                  @endif
                  @endforeach

                @elseif(empty($pro_info['img_pro']))
                <div class="hover-img-location"></div>
                <a href=""><img src="https://via.placeholder.com/412x412.png?text=Kinhmatkool.com" alt=""></a>
                <div class="count-color">Màu Sắc:  {{"0".count($pro_info['prv_id'])}}</div>
                <div class="owl-carousel owl-theme owl__category-small" >
                @foreach ($pro_info['prv_id'] as $index => $prv_id)
                  @php
                    $prv_img = $pro_info['img_prv'][$index] ?? null;
                  @endphp
                  @if ($prv_img)
                  <div class="item slider__item-category-small">
                    <a href="{{ $url ."?variant_id=".$prv_id->prv_id }}"  class="product_variant__item" data-image="{{'https://crm.kinhmatkool.com/uploads/picture/product/smalllest/'. $prv_img[0] }}"><img src="https://via.placeholder.com/42x42.png?text=Kinhmatkool.com" alt=""></a>
                  </div>
                  @endif
                  @endforeach
                @else
                <a  href="{{$url ."?variant_id=".$url_a_main}}" class="hover-img-location"></a>
                <a href="{{$url ."?variant_id=".$url_a_main}}">
                  <img class="cate-origin" src="{{'https://crm.kinhmatkool.com/uploads/picture/product/medium/' .$url_img_main}}" alt="">
                  <img class="hover-image" src="{{'https://crm.kinhmatkool.com/uploads/picture/product/medium/' .$url_img_main}}" />
                 <img class="second-image" src="{{'https://crm.kinhmatkool.com/uploads/picture/product/medium/' . $img_cate_next}}" />
              
                </a>
                <div class="count-color">Màu Sắc:  {{"0".count($pro_info['prv_id'])}}</div>
                <div class="owl-carousel owl-theme owl__category-small" >
                @foreach ($pro_info['prv_id'] as $index => $prv_id)
                  @php
                    $prv_img = $pro_info['img_prv'][$index] ?? null;
                  @endphp
                  @if ($prv_img)
                  <div class="item slider__item-category-small">
                    <a href="{{ $url ."?variant_id=".$prv_id->prv_id }}"  class="product_vari_cate" data-image="{{'https://crm.kinhmatkool.com/uploads/picture/product/medium/'. $prv_img[0]}}"><img src="{{'https://crm.kinhmatkool.com/uploads/picture/product/smalllest/'. $prv_img[0] }}" alt=""></a>
                  </div>
                  @endif
                  @endforeach


                  @endif
                </div>
              </div>
              <div class="group-info-cate">
                @php 
                $parts = explode(" ", $pro_info['pro_prv_id']['pro_name']);
                $pro_name_first  = $parts[0]." ".$parts[1] ;
                $pro_name_last = implode(" ", array_slice($parts, 2));
                @endphp
                <input type="hidden" value="">
                <div class="name__category-product"><span class="name-first">{{$pro_name_first}}</span><span class="name-last">{{" ".$pro_name_last}}</span></div>
                <div class="price__category-product">{{currency_format($pro_info['pro_prv_id']['pro_price'])}}</div>
              </div>
            </div>
            @endforeach
            @php 
            $count_item = session('pro_count', []);
            $count_page = session('count_pages', []);
            @endphp
            <div class="group__load-more">
              <div class="text__load-more">Bạn đang xem 9 trên {{$count_item }} sản phẩm hiện có</div>
              <div class="btn btn__load-more" type='submit'>Xem thêm sản phẩm</div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>


<script>
    current_pages = 1;
    var countItem = @json(session('pro_count', []));
    var countPage = @json(session('count_pages', []));
    var currentUrlWithoutQuery = window.location.origin + window.location.pathname;
    if(countItem == 9){
      $(".btn__load-more").hide();
      $(".text__load-more").css({"font-size":"18px", "margin-bottom" : "20px"})
    }else if(countItem < 9){
       $(".text__load-more").empty();
        $(".text__load-more").text(`Bạn đang xem ${countItem} trên ${countItem} sản phẩm hiện có`)
      $(".btn__load-more").hide();
      $(".text__load-more").css({"font-size":"18px", "margin-bottom" : "20px"})
    }else{
    $(".btn__load-more").on("click", function (e) {
        e.preventDefault();
        if(current_pages < countPage || current_pages * 9 < countItem){
        current_pages ++;
        pagesPost = currentUrlWithoutQuery + "/load" + "?page=" + current_pages;
          $(".detail__category").stop().animate(
            {
                opacity: "0",
            },
            { duration: 100 },
            "linear"
        );
        $.ajax({
            type: "GET",
            dataType: "html",
            url: pagesPost,
            success: function (data) {
            $(".group__load-more").before(data);
            $(".detail__category").stop().animate(
            {
                opacity: "1",
            },
            { duration: 1500 },
            "linear"
             );
              $(".text__load-more").empty();
              if(current_pages * 9 >= countItem){
              $(".text__load-more").text(`Bạn đang xem ${countItem} trên ${countItem} sản phẩm hiện có`);
              $(".btn__load-more").hide();
              $(".text__load-more").css({"font-size":"18px", "margin-bottom" : "20px"})
              }else{
              $(".text__load-more").text(`Bạn đang xem ${current_pages * 9} trên ${countItem} sản phẩm hiện có`);
              }
            },
            error: function (data, textStatus, errorThrown) {
            },
        });
      }else{

      }
    });
  }

</script>
@endsection
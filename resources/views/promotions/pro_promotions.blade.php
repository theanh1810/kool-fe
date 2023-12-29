@extends('layouts.index')

@section('content')


<div class="banner" style="width: 100%">
  <img style="width: 100%"src="{{asset("image/xmas.png")}}" alt="">
</div>

{{-- <div class="breadcrumb"></div> --}}

<div class="container category_con" style="margin-top: 30px;margin-bottom:30px;">
  <div class="row">
    <div class="col-lg-12 category__container" style="display: flex;  flex-direction: column;">
      <div class="container__category">
        <form method="post" class="col-lg-3" id="open__filter-id-sale">
          <div class="filter__by-sex sex-close">
            <div class="filter__btn-sex"><i class="bi bi-caret-down-fill"></i></div>
            <div class="title__filter-open title__filter-by-sex">GIỚI TÍNH</div>
            <div class="filter__by--sex-item">Gọng kính nam</div>
            <div class="filter__by--sex-item">Gọng kính nữ</div>
            <div class="filter__by--sex-item">Gọng kính unisex</div>
          </div>
          <div class="filter__by-sex">
            <div class="title__filter-open title__filter-by-sex">Chương Trình Giảm Giá Khác</div>
            <a href="{{url('product-sale/ci2')}}" ><div class="filter__by--sex-item">Giảm Giá Kính Râm</div></a>
            <a href="{{url('product-sale/ci1')}}" ><div  class="filter__by--sex-item">Giảm Giá Gọng Kính</div></a>
          </div>
        </form>
        <div class="category">
          <div class="title__category-open">Chương trình khuyến mãi {{" ".$promotion_type[0]->prm_name}}</div>
          <div class="detail__category cate-sale">
            @foreach ($page as $value)
             <div class="col-lg-4 detail__category-item-sale">
              <div class="group__category-item">
                @php $url = route('detail_product', ['slug' => $value['pro_info']['0']->pro_slug, 'id' => $value['pro_info']['0']->prv_product_id]); @endphp
                <a href="{{$url ."?variant_id=".$value['pro_info']['0']->prv_id}}"><img src="{{"https://crm.kinhmatkool.com/uploads/picture/product/medium/" . $value['pro_img'][0]->pri_name}}" alt=""></a>
                <div class="group-info-cate-sale">
                @php 
                $parts = explode(" ", $value['pro_info'][0]->pro_name);
                $pro_name_first  = $parts[0]." ".$parts[1] ;
                $pro_name_last = implode(" ", array_slice($parts, 2));
                @endphp
                <div class="name__category-product"><span class="name-first">{{$pro_name_first}}</span><span class="name-last sale">{{" ".$pro_name_last}}</span></div>
                <div class="group__price-sale">
                  <input class="price__after-sale-page" value="{{currency_format($value['pro_info'][0]->prv_price_sale)}}" type="hidden"> 
                  @php 
                    $value_discount = $value['pro_info'][0]->prv_price_sale - ($value['pro_info'][0]->prv_price_sale * ($promotion_type[0]->prm_discount_value / 100));
                  @endphp
                  <div class="price__category-product">{{currency_format($value_discount)}}</div>
                </div>
              </div>
              </div>

            </div>
            @endforeach
          </div>
            <div class="group__load-more">
              @php
                $count_pro_sale = session('pro_count', []);
                @endphp
              @switch($count_pro_sale)
                @case($count_pro_sale < 9)
                  <div class="text__load-more-sale-page">Bạn đang xem {{$count_pro_sale}} trên {{$count_pro_sale}} sản phẩm hiện có</div>
                  @break
                @case($count_pro_sale == 9)
                  <div class="text__load-more-sale-page">Bạn đang xem 9 trên 9 sản phẩm hiện có</div>
                  @break
                @case($count_pro_sale > 9)
                  <div class="text__load-more-sale-page">Bạn đang xem 9 trên {{$count_pro_sale}} sản phẩm hiện có</div>
                  <div class="btn btn__load-more-sale-page" type='submit'>Xem thêm sản phẩm</div>
                  @break
              @endswitch
            </div>
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
    $(".btn__load-more-sale-page").on("click", function (e) {
        e.preventDefault();
        if(current_pages < countPage || current_pages * 9 < countItem){
        current_pages ++;
        pagesPost = currentUrlWithoutQuery + "?page=" + current_pages;
        $(".detail__category").stop().animate(
            {
                opacity: "0",
            },
            { duration: 100 },
            "linear"
        );
        $.ajax({
            type: "POST",
            dataType: "html",
            url: pagesPost,
            data: {
              current_pages: current_pages,
            },
            success: function (data) {
              $(".cate-sale").append(data);
            $(".detail__category").stop().animate(
            {
                opacity: "1",
            },
            { duration: 1000 },
            "linear"
        );
              $(".text__load-more-sale-page").empty();
              if(current_pages * 9 >= countItem){
              $(".text__load-more-sale-page").text(`Bạn đang xem ${countItem} trên ${countItem} sản phẩm hiện có`);
              $(".btn__load-more-sale-page").hide();
              $(".text__load-more-sale-page").css({"font-size":"18px", "margin-bottom" : "20px"})
              }else{
              $(".text__load-more-sale-page").text(`Bạn đang xem ${current_pages * 9} trên ${countItem} sản phẩm hiện có`);
              }
            },
            error: function (data, textStatus, errorThrown) {
            },
        });
      }else{

      }
    });

</script>
@endsection
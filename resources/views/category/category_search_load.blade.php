
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
                <div class="name__category-product"><span class="name-first">{{$pro_name_first}}</span><span class="name-last">{{" ".$pro_name_last}}</span></div>
                <div class="price__category-product">{{currency_format($pro_info['pro_prv_id']['pro_price'])}}</div>
              </div>
            </div>
            @endforeach

<script>
      $(".owl__category-small").owlCarousel({
        margin: 10,
        items: 3, //10 items above 1000px browser width
        itemsDesktop: [1000, 3], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 2], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0;
        itemsMobile: [450, 3], // itemsMobile disabled - inherit from itemsTablet option
        nav: true,
        dots: false,
      });
        $("div.slider__item-u-need-small-detail").on("mouseover", function () {
        if (aa != null) clearTimeout(aa);
        let elm_hover_image = $(this)
            .closest(".slider__item-u-need")
            .find(".hover-image");
        let elm_origin_img = $(this)
            .closest(".slider__item-u-need")
            .find(".slider__a-u-need");
        elm_hover_image.data("origin_img", elm_hover_image.attr("src"));
        elm_origin_img.attr(
            "src",
            $(this).find(".product_variant__item").data("image")
        );
    });
    $(".slider__item-u-need-small-detail").on("mouseleave", function () {
        let elm_hover_image = $(this)
            .closest(".slider__item-u-need")
            .find(".hover-image");
        let elm_origin_img = $(this)
            .closest(".slider__item-u-need")
            .find(".slider__a-u-need");
        aa = setTimeout(function () {
            elm_origin_img.attr("src", elm_hover_image.data("origin_img"));
        }, 100);
    });


    $(".slider__item-u-need>a").on("mouseover", function () {
        $(this).find(".second-image").addClass("second-image-active");
    });

    $(".slider__item-u-need>a").on("mouseout", function () {
        $img_rotate = $(this).find(".second-image");
        if ($img_rotate.hasClass("second-image-active")) {
            $img_rotate.removeClass("second-image-active");
        }
    });
    
    $(".hover-img-location").on("mouseover", function () {
        $(this)
            .siblings("a")
            .find(".second-image")
            .addClass("second-image-active");
    });

    $(".hover-img-location").on("mouseout", function () {
        $img_rotate = $(this).siblings("a").find(".second-image");
        if ($img_rotate.hasClass("second-image-active")) {
            $img_rotate.removeClass("second-image-active");
        }
    });
    
    // slider category
    $(".slider__item-category-small").on("mouseover", function () {
        if (aa != null) clearTimeout(aa);
        let elm_hover_image = $(this)
            .closest(".group__category-item")
            .find(".hover-image");
        let elm_origin_img = $(this)
            .closest(".group__category-item")
            .find(".cate-origin");
        elm_hover_image.data("origin_img", elm_hover_image.attr("src"));
        elm_origin_img.attr(
            "src",
            $(this).find(".product_vari_cate").data("image")
        );
    });
    $(".slider__item-category-small").on("mouseleave", function () {
        let elm_hover_image = $(this)
            .closest(".group__category-item")
            .find(".hover-image");
        let elm_origin_img = $(this)
            .closest(".group__category-item")
            .find(".cate-origin");
        aa = setTimeout(function () {
            elm_origin_img.attr("src", elm_hover_image.data("origin_img"));
        }, 100);
    });
</script>
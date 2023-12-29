
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
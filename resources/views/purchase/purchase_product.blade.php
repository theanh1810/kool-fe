                    <div class="d-flex align-items-center w-100 position-relative item-in-cart">
                        <div class="cart__img--holder">
                            <img class="w-100" src="{{Cart::content( )->first()->options['image_pro']}}" alt="">
                        </div>
                        <div class="cart-item-name-block">
                            <div class="cart-item--text brand-purchase" >Brand: {{Cart::content( )->first()->options['brand_pro']}}</div>
                            <div class="cart-item--text name-purchase" >{{Cart::content( )->first()->name}}</div>
                            <input type="hidden" value="{{Cart::content( )->first()->name}}" name='{{'data_pro[0][pro_name]'}}'>
                            <input class="hidden-data pro-id-purchase" type="hidden" name="{{'data_pro[0][pro_id]'}}" value="{{Cart::content( )->first()->options['pro_id']}}">
                            <input class="hidden-data prv-id-purchase" type='hidden' name="{{'data_pro[0][prv_id]'}}" value="{{Cart::content( )->first()->id}}">
                        </div>
                        <div class="input-group--holder">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <button class="h-100" style="border: 1px solid #DDDDDC;width: 1.6rem;" type="button" id="decrementBtn">-</button>
                                </div>
                                <div style="width: 35px;">
                                    <input type="text" name="{{'data_pro['.'0'.'][qty]'}}" class=" w-100 text-center" style="border: 1px solid #DDDDDC" id="quantityInput" value="{{Cart::content( )->first()->qty}}">
                                </div>
                    
                                <div class="input-group-append">
                                  <button class="h-100" style="border: 1px solid #DDDDDC;width: 1.6rem;" type="button" id="incrementBtn">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="cart__prize--holder">
                            <div class="secondary-prize hidden">2.425.000 đ</div>
                            <div class="primary-prize" >{{currency_format(Cart::content( )->first()->price)}}</div>
                            <input class="hidden-data primary-prize-input" type='hidden' name="{{'data_pro[0][price_pro]'}}" value="{{Cart::content( )->first()->price}}">
                        </div>
                        <button class="cart__discard" type="submit"  value="{{Cart::content( )->first()->rowId}}" >x</button>
                    </div>
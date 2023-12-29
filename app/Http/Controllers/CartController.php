<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Services\CartService;
use \Gloudemans\Shoppingcart\Facades\Cart;


class CartController extends Controller{
  public function addCart(request $request){
    $pro_id = $request-> productId;
    $prv_id = $request-> productPrv;
    $pro_name = $request->  productName;
    $pro_name_color = $request-> productNameColor;
    $pro_qty = $request -> productQty;
    $pro_price = $request -> productPrice;
    $pro_image = $request -> productImage;
    $pro_brand = $request -> productBrand;
      Cart::add([
      'id' => $prv_id,
      'name' => $pro_name,
      "price" => $pro_price,
      'weight' => 0,
      'qty' => $pro_qty,
      'options' => [ 'name_color' => !empty($pro_name_color) ? $pro_name_color : "San pham khong ten", 
                            'pro_id' => !empty($pro_id) ? $pro_id: "San pham khong id",
                            "image_pro" => !empty($pro_image) ? $pro_image: "https://via.placeholder.com/55x55.png?text=Kinhmatkool.com", 
                            "brand_pro" => !empty($pro_brand) ? $pro_brand: "No Brand", 
                          ],
      ]);
    return Cart::count();
  }

  public function buyNow(request $request){
    $pro_id = $request-> productId;
    $prv_id = $request-> productPrv;
    $pro_name = $request->  productName;
    $pro_name_color = $request-> productNameColor;
    $pro_qty = $request -> productQty;
    $pro_price = $request -> productPrice;
    $pro_image = $request -> productImage;
    $pro_brand = $request -> productBrand;
      Cart::destroy();
      Cart::add([
      'id' => $prv_id,
      'name' => $pro_name,
      "price" => $pro_price,
      'weight' => 0,
      'qty' => $pro_qty,
      'options' => [ 'name_color' => !empty($pro_name_color) ? $pro_name_color : "San pham khong ten", 
                            'pro_id' => !empty($pro_id) ? $pro_id: "San pham khong id",
                            "image_pro" => !empty($pro_image) ? $pro_image: "https://via.placeholder.com/55x55.png?text=Kinhmatkool.com", 
                            "brand_pro" => !empty($pro_brand) ? $pro_brand: "No Brand", 
                          ],
      ]);
    return view('purchase/purchase_product');
  } 

  public function removeCartItem (request $request){
    $row_id = $request->rowId;
    $cart = Cart::content()->where('rowId',$row_id);
       if($cart->isNotEmpty()){
           Cart::remove($row_id);
       };
       $count_pro = Cart::count();
       return view('purchase/cart_discard', compact('count_pro'));
  }
  public function changeCart (request $request){
    $row_id = $request->rowId;
    $value_qty = $request-> inputValue;
    Cart::update($row_id, $value_qty);
    return Cart::count();
  }

}
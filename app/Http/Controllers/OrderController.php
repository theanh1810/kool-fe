<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Services\OrderService;
use App\Http\Requests\PurchaseInfoRequest;
use App\Http\Requests\OrdercheckRequest;
use \Gloudemans\Shoppingcart\Facades\Cart;


class OrderController extends Controller{
      public function getCity(){
        $all_city = [];
        $all_city_district = [];
        $city =OrderService::getInstance()->getCity();
        foreach($city as $key => $value){
            $city_id = $key + 1;
            $all_city[$city_id] = [
                'cit_id' => $value->cit_id,
                'cit_name' => $value->cit_name,
            ];
        }
        foreach($all_city as $key => $value){
             $all_city_district[$key] = [
                 'cit_id' => $value['cit_id'],
                 'cit_name' => $value['cit_name'],
                 'district' => OrderService::getInstance()->getDistricts($value['cit_id']),
             ];

        }


        return view('purchase/purchase_form', compact("all_city_district"));
    }

    public function getDistrict(Request $request){
        $city_id = $request->cityId;
        $district_by_city = OrderService::getInstance()->getDistricts($city_id);
        $all_dis = [];
        foreach($district_by_city as $key => $value){
            $key_dis = $key +1;
            $all_dis[$key_dis] = [
                'dis_id' => $value->dis_id,
                'dis_name' => $value->dis_name,
            ];
        }
        return $all_dis;
    }

    public function getWard(Request $request){
        $district_id = $request->districtId;
        $ward_by_city = OrderService::getInstance()->getWard($district_id);
        $all_ward = [];
        foreach($ward_by_city as $key => $value){
            $key_ward = $key +1;
            $all_ward[$key_ward] = [
                'war_id' => $value->war_id,
                'war_name' => $value->war_name,
            ];
        }
        return $all_ward;
    }

    

public function addOrder(PurchaseInfoRequest $request){
    $info_customer = [
        'email' => $request->email,
        'fullName' => $request->fullName,
        'sexCustomer' => $request->sex_customer,
        'cityAddress' => $request->select_city,
        'districtAddress' => $request->select_district,
        'wardAddress' => $request->select_ward,
        'detailAddress' => $request->detailAddress,
        'numberPhone' => $request->numberPhone,
    ];
    // $info_product = [
    //     'pro_name' => $request->name_pro,
    //     'proId' => $request->pro_id,
    //     'prvId' => $request->prv_id,
    //     'qty' => $request->qty_pro,
    //     'proPrice' => $request-> price_product,
    // ];

    $info_product = $request->input('data_pro');
    $info_product_reset = array_values($info_product);
    $info_total = [
        'totalPrice' => $request->total_price,
        'totalSale' => $request->total_sale,
        'totalAfterSale' => $request->total_after_sale
    ];


    $created_at = time();
    $new_customer_id = OrderService::getInstance()->createCustomer($info_customer);
    // tao them don dat hang moi 
    $new_order_id = OrderService::getInstance()->createOrder($info_customer,$info_total, $info_product, $new_customer_id, $created_at);
    foreach ($info_product as $value){
        OrderService::getInstance()->createOrderProduct($new_order_id ,$value, $created_at);
    }
    $new_order_code = OrderService::getInstance()->getOrdCode($new_order_id);
    Cart::destroy();
    $data_order_success = [
        'ord_name_cus' => $info_customer['fullName'],
        'ord_code' => $new_order_code,
        'ord_price_pay' => $info_total['totalAfterSale'],
    ];
    return view('purchase/purchase_succeed' , compact('data_order_success'));
  }

    public function detailSearchOrder()
    {
        return view('order-check/search_order');
    }
    public function detailSearchInfor(OrdercheckRequest $request)
    {
        $ord_code_input = $request->OrderCodeCheck;
        $number = $request->numberPhoneCheck;
        if(empty($ord_code_input)){
        $ord_code = OrderService::getInstance()->getCodeByPhone($number);
        }else{
        $ord_code = OrderService::getInstance()->getCodeByOrdCode($ord_code_input);
        }
        return view('order-check/search_infor', compact('ord_code'));
    }

}


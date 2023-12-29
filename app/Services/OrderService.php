<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Wards;
use App\Models\Customers;
use App\Models\Order;
use App\Models\OrderProducts;

class OrderService extends BaseService{

    public function getCity(){
        $record_city = Cities::select('cit_id', 'cit_name')->get();
        return $record_city;
    }
    public function getCityName($cit_id){
        $record_city_name = Cities::select('cit_name')->where('cit_id', $cit_id)->get();
        return $record_city_name;
    }
    public function getDistricts($cit_id){
        $record_district = Districts::select( 'dis_name', 'dis_id')->where("dis_city_id", $cit_id)->get();
        return $record_district;
    }

    public function getDistrictsName($dis_id){
        $record_district_name = Districts::select( 'dis_name')->where("dis_id", $dis_id)->get();
        return $record_district_name;
    }

    public function getWard($dis_id){
        $record_ward = Wards::select('war_id', 'war_name')->where("war_district_id", $dis_id)->get();
        return $record_ward;
    }

    public function getWardName($war_id){
        $record_ward_name = Wards::select('war_name')->where("war_id", $war_id)->get();
        return $record_ward_name;
    }

	public function createCustomer($data){
        $customer = new Customers;
        $customer->cus_phone = $data['numberPhone'];
        $customer->cus_name = $data['fullName'];
        $customer->cus_sex = $data['sexCustomer'];
        $customer->cus_email = $data['email'];
        $customer->cus_address = $data['detailAddress'];
        $customer->cus_city_id = $data['cityAddress'];
        $customer->cus_district_id = $data['districtAddress'];
        $customer->cus_wards_id = $data['wardAddress'];
        $customer->save();
        if ($customer->save()) {
        return $customer->cus_id;
        } else {
        alert('false');
	}
    }

    public function orderCodeExists($code)
	{
        $order_code = Order::select("ord_id")->where("ord_code", $code)->limit(1)->first();    
		return empty($order_code) ? 0 : $order_code;
	}

    public function createOrder($data_cus, $data_total, $data_product, $customer_id, $created_at){
        $ord_note = 'test';
        do {
			$data_order_code = generate_order_code();
		    if ($this->orderCodeExists($data_order_code)) {
				$data_order_code = null;
			}
		} while (empty($data_order_code));
        $order = new Order;
        $order->ord_code = $data_order_code;
        $order->ord_phone = $data_cus['numberPhone'];
        $order->ord_fullname = $data_cus['fullName'];
        $order->ord_sex = $data_cus['sexCustomer'];
        $order->ord_email = $data_cus['email'];
        $order->ord_address = $data_cus['detailAddress'];
        $order->ord_city_id = $data_cus['cityAddress'];
        $order->ord_district_id = $data_cus['districtAddress'];
        $order->ord_wards_id = $data_cus['wardAddress'];
        $order->ord_note= $ord_note;
        $order->ord_products = encode_base_json($data_product);
        $order->ord_money = $data_total['totalPrice'];
        $order->ord_discount = $data_total['totalSale'];
        $order->ord_money_pay = $data_total['totalAfterSale'];
        $order->ord_created_at = $created_at;
        $order->ord_customer_id = $customer_id;
        $order->save();
        if ($order->save()) {
                return $order->ord_id;
        } else {
        alert('false');
	}
    }
    
    public function getOrdCode($ord_id){
        $ord_code = Order::select("ord_code")->where("ord_id", $ord_id)->first();
        return $ord_code;
    }

    public function getCode($phone, $ord_code) {
        $ord_code = Order::select("ord_code")->where("ord_phone", $phone)->where("ord_code", $ord_code)->get();
        return $ord_code;
    }  
    public function createOrderProduct($ord_id, $data_product, $created_at){
        $order_product = new OrderProducts;
        $order_product->orp_name = $data_product['pro_name'];
        $order_product->orp_qty = $data_product['qty'];
        $order_product->orp_created_at = $created_at;
        $order_product->orp_product_id = $data_product['pro_id'];
        $order_product->orp_price = $data_product['price_pro'];
        $order_product->orp_order_id = $ord_id;
        $order_product->orp_variation_id = $data_product['prv_id'];
        $order_product->save();
    //     if ( $order_product ->save()) {
    //         alert("oke");
    //     } else {
    //     alert('false');
	// }        
    }
}
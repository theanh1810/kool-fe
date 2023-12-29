<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Warranty;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Product;
use App\Models\ProductVariations;
use App\Models\Brand;
use App\Models\Customers;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Wards;
use App\Models\ProductImage;

class WarrantyService extends BaseService
{
  public function getCheckWarranty($phone_number, $order_code){
      $record_info = Order::select('ord_id')->where('ord_phone', $phone_number)->where('ord_code', $order_code)->get();
      return $record_info;
  }

  public function getAllProWarranty(){
    $record_info = Warranty::select('war_product_id', 'war_product_variation_id', 'war_to_time')->get();
    return $record_info;
  }

  public function addStatusWarranty($pro_id, $prv_id){
    $warranty_product = Warranty::where('war_product_variation_id', $prv_id)->where('war_product_id' , $pro_id)->get();
    if($warranty_product){
    foreach($warranty_product as $value){
      $value->war_status = 4;
      $value->save();
    };
      return "success";
    }else{
      return "false";
    }
  }
  public function getPrvId($ord_id){
    $record_info = Warranty::select('war_product_id', 'war_product_variation_id', 'war_from_time', 'war_to_time')->where('war_order_id', $ord_id)->get();
    return $record_info;
  }
  public function getCusInfo($phone_number, $order_code){
      $record_info = Order::select('ord_phone', 'ord_fullname', 'ord_email', 'ord_address', 'ord_city_id', 'ord_district_id', 'ord_wards_id', 'ord_created_at', 'ord_year_of_birth')->where('ord_phone', $phone_number)->where('ord_code', $order_code)->get();
      return $record_info;
  }

  public function getCity($city_id){
    $record_info = Cities::select('cit_name')->where('cit_id', $city_id)->get();
    return $record_info;
  }
  public function getDistrict($district_id){
    $record_info = Districts::select('dis_name')->where('dis_id', $district_id);
    return $record_info;
  }

  public function getWards ($ward_id){
    $record_info = Wards::select('war_name')->where('war_id', $ward_id)->get();
    return $record_info;
  }
  public function getProInfo($pro_id, $prv_id){
    $record_info = ProductVariations::select('prv_name', 'prv_sku', 'pro_name', 'pro_slug','pro_brand_id')->where('prv_id', $prv_id)->where('prv_product_id', $pro_id)->join('products', 'prv_product_id', 'pro_id')->get();
    return $record_info;
  }
  public function getProBrand($pro_brand_id){
    $record_info = Brand::select('bra_name')->where('bra_id', $pro_brand_id)->get();
    return $record_info;
  }
  public function getImage($pro_id, $prv_id){
    $record_info = ProductImage::select('pri_name')->where('pri_product_variation_id', $prv_id)->where('pri_product_id', $pro_id)->first();
    return $record_info;
  }
}
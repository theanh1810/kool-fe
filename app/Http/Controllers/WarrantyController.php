<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\WarrantyService;
use App\Http\Requests\OrdercheckRequest;

class WarrantyController extends Controller
{
  public function index(){
    return view('order-check/search_warranty');
  }
  public function getWarranty(OrdercheckRequest $request){
    $phone_number = $request->numberPhoneCheck;
    $ord_code = $request->OrderCodeCheck;
    $ord_id_ojb = WarrantyService::getInstance()->getCheckWarranty($phone_number, $ord_code);
    if($ord_id_ojb->isEmpty()){
      $pro_info_check = [];
      return view('order-check/warranty_info', compact('pro_info_check'));
    }else{
      $ord_id = $ord_id_ojb[0]->ord_id;
    }
    $pro_prv_id = WarrantyService::getInstance()->getPrvId($ord_id);
    $warranty_info_cus = WarrantyService::getInstance()->getCusInfo($phone_number, $ord_code);

    if($warranty_info_cus[0]->ord_city_id == null || empty($warranty_info_cus[0]->ord_city_id)){
      $city = '';
    }else{
          $city_obj = WarrantyService::getInstance()->getCity($warranty_info_cus[0]->ord_city_id);
      $city     = $city_obj[0]->cit_name;
    }

    if($warranty_info_cus[0]->ord_district_id == null || empty($warranty_info_cus[0]->ord_district_id)){
      $district = '';
    }else{
      $district_obj = warrantyService::getInstance()->getDistrict($warranty_info_cus[0]->ord_district_id);
      $district     = $district_obj[0]->dis_name;
    }

    if($warranty_info_cus[0]->ord_wards_id == null || empty($warranty_info_cus[0]->ord_wards_id)){
      $ward = '';
    }else{
      $ward_obj = warrantyService::getInstance()->getWards($warranty_info_cus[0]->ord_wards_id);
      $ward = $ward_obj[0]->war_name;
    }    
    $address = $warranty_info_cus[0]->ord_address;
    if(!empty($city)){
      if(!empty($district)){
        if(!empty($ward)){
          if(!empty($address)){
            $address_full = `$address . ',' . $ward . ',' . $district . ',' . $city`;
          }else{
            $address_full = `$ward . ',' . $district . ',' . $city`;
          }
        }else{
            $address_full = `$district . ',' . $city`;
        }
      }else{
        $address_full = `$city`;
      }
    }else{
      $address_full = "";
    }
    $pro_info_check = [
      'cus_info' => $warranty_info_cus,
    ];
    $war_info = [];
     $pro_info_check['war_info'] = $pro_prv_id->map(function ($value, $key) use ($war_info) {
      $pro_value = WarrantyService::getInstance()->getProInfo($value->war_product_id, $value->war_product_variation_id);
      $pro_brand_id   = $pro_value[0]->pro_brand_id;
      $pro_brand_name = WarrantyService::getInstance()->getProBrand($pro_brand_id);
      $proImage =  WarrantyService::getInstance()->getImage($value->war_product_id, $value->war_product_variation_id);
      $war_info = [
        'war_time_from' => $value->war_from_time,
        'war_time_to' => $value->war_to_time,
        'prv_name' => $pro_value[0]->prv_name,
        'prv_sku' => $pro_value[0]->prv_sku,
        'pro_name' => $pro_value[0]->pro_name,
        'pro_slug' => $pro_value[0]->pro_slug,
        'pro_id' => $value->war_product_id,
        'prv_id' => $value->war_product_variation_id,
        'brand_name' => $pro_brand_name[0]->bra_name,
        'pro_image' => $proImage->pri_name,
      ];
      return $war_info;
    });

    return view('order-check/warranty_info', compact('pro_info_check', 'address_full', 'ord_code','phone_number'));
  }
  

}
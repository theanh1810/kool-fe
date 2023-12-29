<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\ProductPromotions;
use App\Models\Promotions;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariations;
use App\Models\Post;

class PromotionsService extends BaseService
{
  public function getPromotions(){
    $record_info = Promotions::select("prm_id", "prm_name", "prm_discount_value", "prm_discount_type")->get();
    return $record_info;
  }

  public function getPromotionsById($id){
    $record_info = Promotions::select("prm_id", "prm_name", "prm_discount_value", "prm_discount_type", 'prm_banner', "prm_description")->where('prm_id', $id)->get();
    return $record_info;
  }
  public function getProByPromotionsId($promotions_id){
    $record_info = ProductPromotions::select("ppr_product_id", "ppr_product_variation_id")->where("ppr_promotion_id", $promotions_id)->get();
    return $record_info;
  }

  public function getProPromotionsCheck($pro_id, $prv_id){
    $record_info = ProductPromotions::select("ppr_promotion_id")->where("ppr_product_id", $pro_id)->where('ppr_product_variation_id', $prv_id)->get();
    return $record_info;
  }
  public function getDetailPro($pro_id, $prv_id){
    $record_info = ProductVariations::select(ProductVariations::getTableName() .".*", "pro_name","bra_name",'pro_slug', )->where('prv_id', $prv_id)->where('prv_product_id', $pro_id)->join('products', 'prv_product_id', 'pro_id')->join('brand', 'pro_brand_id', 'bra_id')->get();
    return $record_info;
  }
  public function getImagePro($pro_id, $prv_id){
    $record_info = ProductImage::select("pri_name")->where('pri_product_id', $pro_id)->where('pri_product_variation_id', $prv_id)->get();
    return $record_info;  
  }


}

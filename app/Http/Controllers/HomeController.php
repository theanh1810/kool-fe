<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PromotionsService;
use App\Services\BlogService;
use App\Services\ProductService;
use App\Services\CategoriesService;
use App\Services\ImageService;
class HomeController extends Controller{
  public function index(){
  $promotions = PromotionsService::getInstance()-> getPromotions();
  $promotions_info = [];
  $promotions_pro_info = [];
  $pro_info = [];
  $pro_image = [];
foreach ($promotions as $key => $promotion_item) {
    // Định nghĩa tên của mảng dựa trên key và bắt đầu từ 1
    $arrayKey = 'promotions_' . ($key + 1);
    // Trích xuất thông tin từ mỗi đối tượng promotion
    $promotions_info[$arrayKey] = [
        'prm_id' => $promotion_item->prm_id,
        'prm_name' => $promotion_item->prm_name,
        'prm_discount_value' => $promotion_item->prm_discount_value,
        'prm_discount_type' => $promotion_item->prm_discount_type,
        'prm_product' => PromotionsService::getInstance()-> getProByPromotionsId($promotion_item->prm_id),
    ];

    foreach($promotions_info[$arrayKey]['prm_product'] as $key => $value){
       $promotions_pro_info[$key] = [
        "ppr_product_id" => $value->ppr_product_id,
        "ppr_product_variation_id" =>  $value->ppr_product_variation_id,
        "pro_info" => PromotionsService::getInstance()-> getDetailPro($value->ppr_product_id,$value->ppr_product_variation_id ),
        'pro_image' => PromotionsService::getInstance()-> getImagePro($value->ppr_product_id,$value->ppr_product_variation_id ),
       ];
       
    }

    $promotions_info[$arrayKey]['prm_product'] = $promotions_pro_info;
}

  $brand = ProductService::getInstance()->getBrand();
  $banner = ImageService::getInstance()->getBanner();
// lay san pham theo promotions

    $post = BlogService::getInstance()-> getPostHome();
    return view('home', compact('promotions_info', "post", "brand", "banner"));
}

  public function aboutUs(){
    return view('about-us/about-us');
  }

  public function getCategories(){
    $list_categories_parent = CategoriesService::getInstance()->getCategoriesParent();
    dd($list_categories_parent);
    foreach ($list_categories_parent as $value){
    
    }
    return view('elements/header', compact('list_categories_parent'));
  }

  public function searchPro(){
    $pro_list = ProductService::getInstance()->getPro();
  }
  
}
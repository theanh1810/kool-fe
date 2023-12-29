<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\ProductImage;
use App\Models\Banner;


class ImageService extends BaseService{

  public function getImages($pro_id, $prv_id){
     $record_img_pro = ProductImage::select(ProductImage::getTableName().".*")
        ->where('pri_product_id', $pro_id)
        ->where('pri_product_variation_id', $prv_id)
        ->orderBy('pri_id', 'asc')
        ->get();
      return $record_img_pro;
  }

  public function getBanner(){
         $record_img_pro = Banner::select('ban_title','ban_description','ban_image', 'ban_position', 'ban_image', 'ban_link', 'ban_label', 'ban_text_link')
        ->get();
      return $record_img_pro;
  }
  
}


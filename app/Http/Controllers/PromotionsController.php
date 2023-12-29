<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PromotionsService;
use Illuminate\Pagination\Paginator;

class PromotionsController extends Controller
{
    public function detailPromotion(Request $request, $id)
    {
      $page_current = $request->current_pages;
      $promotion_type = PromotionsService::getInstance()->getPromotionsById($id);
      $promotion_id = $promotion_type[0]->prm_id;
      $promotion_pro_id_prv = PromotionsService::getInstance()->getProByPromotionsId($promotion_id);
      $promotion_pro = [];
      foreach($promotion_pro_id_prv as $key => $value) {
         $value_fake = PromotionsService::getInstance()->getDetailPro($value->ppr_product_id, $value->ppr_product_variation_id);
         $img_pro = PromotionsService::getInstance()-> getImagePro($value->ppr_product_id, $value->ppr_product_variation_id);
        if($value_fake->isNotEmpty()){
          $promotion_pro[$key] = [
            'pro_info' =>  $value_fake,
            'pro_img' => $img_pro,
          ];
         
        }
      }
      $promotion_pro = array_values($promotion_pro);
      $perItem = 9;
      $paginate = [];
      $page = 1;

      for ($i = 0; $i < count($promotion_pro); $i += $perItem) {
        $arr_item = array_slice( $promotion_pro, $i,  $perItem );
        $paginate[$page] = $arr_item;
        $page++;
      }
      
      $count_pro_sale = count($promotion_pro);
      $count_pages = count($paginate);
      
        session(['pro_count' => $count_pro_sale]);
        session(['count_pages' => $count_pages]);
        if(!empty($page_current)){
          $page= $paginate[$page_current];
          return view('promotions/pro_promotion_load', compact('promotion_type', 'page'));
        }
      $page= $paginate[1];
      return view('promotions/pro_promotions', compact('promotion_type', 'page'));
    }

  }

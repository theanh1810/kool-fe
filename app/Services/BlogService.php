<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Post;

class BlogService extends BaseService{
    public function getPostHome(){
    $record_info = Post::select("pos_title", "pos_excerpt", "pos_image", 'pos_id', 'pos_slug')->inRandomOrder()->limit(3)->get();
    return $record_info;  
    } 

    public function getPostCate($pos_cate_id){
      $record_info = Post::select("pos_title", "pos_excerpt", "pos_image", "pos_slug", "pos_id", "pos_created_at")->where('pos_category_id', $pos_cate_id)->where("pos_active", 1)->get();
      return $record_info;
    }

    public function getDetailPost($pos_id){
      $record_info = Post::select('pos_content', 'pos_category_id', 'pos_created_at','pos_title')->where('pos_id', $pos_id)->get();
      return $record_info;
    }


}
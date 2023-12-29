<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BlogService;

class BlogController extends Controller{

  public function getPostCate($slug , $id){
    $post = BlogService::getInstance()->getPostCate($id);
    return view('/blog/blog-cate' , compact("post"));

  }

  public function getDetailPost($slug, $id){
        $post_content = BlogService::getInstance()->getDetailPost($id);
        $post = BlogService::getInstance()->getPostCate($post_content[0]->pos_category_id);
        return view('/blog/detail-blog', compact('post_content', 'post'));
  }
}
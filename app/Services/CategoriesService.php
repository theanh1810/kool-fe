<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Categories;

class CategoriesService extends BaseService
{
  public function getCategoriesParent(){
    $record_info = Categories::select("cat_id", "cat_name", "cat_name_url")->where('cat_parent_id', 0)->where('cat_active', 1)->get();
    return $record_info;
  }
  public function getCategoriesChild($cat_parent_id){
    $record_info = Categories::select("cat_id", "cat_name", "cat_name_url")->where('cat_parent_id', $cat_parent_id)->where('cat_show_home', 1)->where('cat_active', 1)->get();
  return $record_info;
  }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\ProductVariations;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ContentProduct;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Wards;
use App\Models\ProductAttributes;
use App\Models\ProductOptions;
class ProductService extends BaseService
{
    // public function getDetailPro($pro_id)
    // {
    //     $record_info = Product::select( Product::getTableName() .".*",'bra_name')->where('pro_id', $pro_id)->where('pro_active', 1)
    //     ->join('brand', 'pro_brand_id',  'bra_id')
    //     ->get();

    //     return $record_info;
    //     //lay tat ca thong tin san pham
    // }

    public function getBrandAll(){
        $record_info = Brand::select("bra_name", "bra_id")->get();
        return $record_info;
    }
    public function filterMaterial($pat_value, $pat_option_id){
        $record_info = ProductAttributes::select("pat_product_id")->where("pat_value", $pat_value)->where("pat_option_id", $pat_option_id)->get();
        return $record_info;
    }
    public function filterMaterialMany($pat_value, $pat_option_id){
        $record_info = ProductAttributes::select("pat_product_id")->whereIn("pat_value", $pat_value)->where("pat_option_id", $pat_option_id)->get();
        return $record_info;
    }
    public function getDetailPro($pro_id, $prv_id){
        $record_info = ProductVariations::select(ProductVariations::getTableName() .".*", "pro_name", "pro_brand_id", "bra_name","pro_category_id")->where('prv_id', $prv_id)->where('prv_product_id', $pro_id)->join('products', 'prv_product_id', 'pro_id')->join('brand', 'pro_brand_id', 'bra_id')->get();
        return $record_info;
    }
    public function getProOptions($pop_id){
        $record_info = ProductOptions::select("pop_value")->where('pop_id', $pop_id)->get();
        return $record_info;
    }
    public function getProByBrand($pro_brand_id, $cat_id){
        if ($cat_id == 1) {
            $record_info = Product::select("pro_id", "pro_name", "pro_slug", "pro_category_id", "pro_price_sale", "pro_brand_id", "pro_created_at")->whereIn('pro_brand_id', $pro_brand_id)->where('pro_active', 1)->get();
            return $record_info;
        } else if($cat_id == 5){
            $record_info = Product::select("pro_id", "pro_name", "pro_slug", "pro_category_id", "pro_price_sale", "pro_brand_id", "pro_created_at")->whereIn('pro_brand_id', $pro_brand_id)->where('pro_active', 1)->where('pro_collection_id', 3)->get();
            return $record_info;   
        }else{
            $record_info = Product::select("pro_id", "pro_name", "pro_slug", "pro_category_id", "pro_price_sale", "pro_brand_id", "pro_created_at")->whereIn('pro_brand_id', $pro_brand_id)->where('pro_active', 1)->where('pro_category_id', $cat_id)->get();
            return $record_info;   
        }
    }
    public function getDetailProFilter($pro_id, $cat_id){
        if ($cat_id == 1) {
            $record_info = Product::select("pro_id", "pro_name", "pro_slug", "pro_category_id", "pro_price_sale", "pro_brand_id", "pro_created_at")->where('pro_id', $pro_id)->where('pro_active', 1)->get();
            return $record_info;
        }else if($cat_id == 5){
            $record_info = Product::select("pro_id", "pro_name", "pro_slug", "pro_category_id", "pro_price_sale", "pro_brand_id", "pro_created_at")->where('pro_id', $pro_id)->where('pro_collection_id', 3)->where('pro_active', 1)->get();
            return $record_info;
        }else{
            $record_info = Product::select("pro_id", "pro_name", "pro_slug", "pro_category_id", "pro_price_sale", "pro_brand_id", "pro_created_at")->where('pro_id', $pro_id)->where('pro_category_id', $cat_id)->where('pro_active', 1)->get();
            return $record_info;
        }

    }

    public function getContentPro($pro_id){
        $record_info = ContentProduct::select("prc_content")->where('prc_product_id', $pro_id)->get();
        return $record_info;
    }

    public function getUrlCate($id){
        $record_url_cate = Category::select('cat_id','cat_url_name')->where('cat_id', $id)->get();
        return $record_url_cate;
    }
    public function getProCate($id)
    {
        if($id == 5){
        $pro_cate = Product::select(Product::getTableName() .".*", 'bra_name')->where('pro_collection_id', 3)->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')
        ->join('categories', 'pro_category_id', 'cat_id')->paginate(9);
        return $pro_cate;
        }else if($id == 1){
        $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')
        ->join('categories', 'pro_category_id', 'cat_id')->paginate(9);
        return $pro_cate;
        }else if($id >1){
        $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_category_id', $id)->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')
        ->join('categories', 'pro_category_id', 'cat_id')->paginate(9);
        return $pro_cate;
        }
        //lay tat ca thong tin san pham trong category
    }

    public function getBrand(){
        $pro_brand = Brand::select('bra_name', 'bra_logo')->get();
        return $pro_brand;
    }
   
    public function getProSlider($cat_id)
    { 
        if($cat_id == 5){
        $pro_slider = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_category_id', 2)->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')
        ->join('categories', 'pro_category_id', 'cat_id')
        ->inRandomOrder()->limit(20)
        ->get();
        return $pro_slider;
        } else {
            $pro_slider = Product::select(Product::getTableName() . ".*", 'bra_name')->where('pro_category_id', $cat_id)->where("pro_active", 1)
                ->join('brand', 'pro_brand_id', 'bra_id')
                ->join('categories', 'pro_category_id', 'cat_id')
                ->inRandomOrder()->limit(20)
                ->get();
            return $pro_slider;
        }
        //lay tat ca thong tin san pham trong category
    }

    public function getPrvByProId ($pro_id){
        $prv_slider = ProductVariations::select('prv_id', "prv_active","prv_name")->where('prv_product_id', $pro_id)->orderBy('prv_active', 'desc')->get();
        return $prv_slider;
    }

    public function getNameByPrvId ($pro_id){
        $prv_name = ProductVariations::select('prv_id',"prv_name")->where('prv_product_id', $pro_id)->get();
        return $prv_name;
    }
    
    public function getSlugByProId ($pro_id){
        $pro_slug_color = Product::select('pro_slug',"pro_id")->where('pro_id', $pro_id)->get();
        return $pro_slug_color;
    }    

    public function getImagePro($pro_id){
        $record_image_main = ProductImage::select(ProductImage::getTableName() .".*")->where('pri_product_id', $pro_id)->where('pri_product_variation_id', 0)->orderBy('pri_id', 'asc')->get();
        return $record_image_main;   
    }
    public function getImagePrv($pro_id, $prv_id){
        $record_image_prv = ProductImage::select(ProductImage::getTableName() .".*")->where('pri_product_id', $pro_id)->where('pri_product_variation_id', $prv_id)->orderBy('pri_id', 'asc')->get();
        return $record_image_prv;
    }

    public function getPro(){
        $record = Product::select("pro_id", "pro_name", "pro_slug", "pro_category_id", "pro_price_sale", "pro_brand_id", "pro_created_at")->where("pro_active", 1)->get();
        return $record;
    }

    public function orderProFilter($cat_id, $minPrice, $maxPrice, $orderValue){
        if($orderValue == "asc"){
            if($cat_id == 5){
                $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_collection_id', 3)->where("pro_active", 1) ->whereBetween('pro_price_sale', [$minPrice, $maxPrice])
                ->join('brand', 'pro_brand_id',  'bra_id')
                ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_price_sale', 'asc')->get();
                return $pro_cate;
            }else if($cat_id == 1){
                $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where("pro_active", 1) ->whereBetween('pro_price_sale', [$minPrice, $maxPrice])
                ->join('brand', 'pro_brand_id',  'bra_id')
                ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_price_sale', 'asc')->get();
                return $pro_cate;
            }elseif($cat_id > 1){
                $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_category_id', $cat_id)->where("pro_active", 1) ->whereBetween('pro_price_sale', [$minPrice, $maxPrice])
                ->join('brand', 'pro_brand_id',  'bra_id')
                ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_price_sale', 'asc')->get();
                return $pro_cate;
            }
        }else if($orderValue == "desc"){
            if($cat_id == 5){
                $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_collection_id', 3)->where("pro_active", 1) ->whereBetween('pro_price_sale', [$minPrice, $maxPrice])
                ->join('brand', 'pro_brand_id',  'bra_id')
                ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_price_sale', 'desc')->get();
                return $pro_cate;
            }else if($cat_id == 1){
                $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where("pro_active", 1) ->whereBetween('pro_price_sale', [$minPrice, $maxPrice])
                ->join('brand', 'pro_brand_id',  'bra_id')
                ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_price_sale', 'desc')->get();
                return $pro_cate;
            }elseif($cat_id > 1){
                $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_category_id', $cat_id)->where("pro_active", 1) ->whereBetween('pro_price_sale', [$minPrice, $maxPrice])
                ->join('brand', 'pro_brand_id',  'bra_id')
                ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_price_sale', 'desc')->get();
                return $pro_cate;
            }     
        }else if($orderValue == "new"){
            if($cat_id == 5){
                $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_collection_id', 3)->where("pro_active", 1) ->whereBetween('pro_price_sale', [$minPrice, $maxPrice])
                ->join('brand', 'pro_brand_id',  'bra_id')
                ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_created_at', 'new')->get();
                return $pro_cate;
            }else if($cat_id == 1){
                $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where("pro_active", 1) ->whereBetween('pro_price_sale', [$minPrice, $maxPrice])
                ->join('brand', 'pro_brand_id',  'bra_id')
                ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_created_at', 'new')->get();
                return $pro_cate;
            }else if($cat_id >1){
                $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_category_id', $cat_id)->where("pro_active", 1) ->whereBetween('pro_price_sale', [$minPrice, $maxPrice])
                ->join('brand', 'pro_brand_id',  'bra_id')
                ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_created_at', 'new')->get();
                return $pro_cate;                
            }            
        }

    }

    
    public function proFilter($cat_id, $minPrice, $maxPrice){
            if($cat_id == 5){
                $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_collection_id', 3)->where("pro_active", 1) ->whereBetween('pro_price_sale', [$minPrice, $maxPrice])
                ->join('brand', 'pro_brand_id',  'bra_id')
                ->join('categories', 'pro_category_id', 'cat_id')->get();
                return $pro_cate;
            }else if($cat_id == 1){
                $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where("pro_active", 1)->whereBetween('pro_price_sale', [$minPrice, $maxPrice])
                ->join('brand', 'pro_brand_id',  'bra_id')
                ->join('categories', 'pro_category_id', 'cat_id')->get();
                return $pro_cate;
            }else if($cat_id > 1){
                $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_category_id', $cat_id)->where("pro_active", 1) ->whereBetween('pro_price_sale', [$minPrice, $maxPrice])
                ->join('brand', 'pro_brand_id',  'bra_id')
                ->join('categories', 'pro_category_id', 'cat_id')->get();
                return $pro_cate;
            }
    }    
        public function orderProAsc($cat_id){
        if($cat_id == 5){
        $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_collection_id', 3)->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')
        ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_price_sale', 'asc');
        return $pro_cate;
        }else if($cat_id == 1){
        $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')
        ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_price_sale', 'asc');
        return $pro_cate;
        }else if($cat_id > 1){
        $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_category_id', $cat_id)->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')
        ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_price_sale', 'asc');
        return $pro_cate;
        }
    }

    public function orderProDesc($cat_id){
        if($cat_id == 5){
        $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_collection_id', 3)->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')
        ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_price_sale', 'desc');
        return $pro_cate;
        }else if($cat_id == 1){
        $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')
        ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_price_sale', 'desc');
        return $pro_cate;
        }else if($cat_id > 1){
        $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_category_id', $cat_id)->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')
        ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_price_sale', 'desc');
        return $pro_cate;            
        }
    }

    public function orderProNew($cat_id){
        if($cat_id == 5){
        $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_collection_id', 3)->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')
        ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_created_at', 'desc');
        return $pro_cate;
        }else if($cat_id == 1){
        $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')
        ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_created_at', 'desc');
        return $pro_cate;
        }else if($cat_id > 1){
        $pro_cate = Product::select( Product::getTableName() .".*", 'bra_name')->where('pro_category_id', $cat_id)->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')
        ->join('categories', 'pro_category_id', 'cat_id')->orderBy('pro_created_at', 'desc');
        return $pro_cate;
        }
    }

    public function getProByQuery($key_search){
        $record_info = Product::select(Product::getTableName() .".*", 'bra_name')->where(function($query) use ($key_search){
            $query->where('pro_name', 'like', "%{$key_search}%")->orWhere('pro_sku', 'like', "%{$key_search}%");
        })->where("pro_active", 1)
        ->join('brand', 'pro_brand_id',  'bra_id')->paginate(9);
        return $record_info;
    }

}
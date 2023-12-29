<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\ImageService;
use App\Services\PromotionsService;
use App\Models\Product;
use App\Models\ProductVariations;
use App\Models\Post;

class ProductController extends Controller
{
    public function detailProduct(Request $request, $slug, $id)
    {
        // lay id tu duong dan
       
        $prv_id = $request->query('variant_id');
        // lay thong tin san pham
        // lay thong tin bien the san pham
        $pro_detail = ProductService::getInstance()->getDetailPro($id, $prv_id);
        $pro_promo_check = PromotionsService::getInstance()->getProPromotionsCheck($id, $prv_id);
        if($pro_promo_check->isNotEmpty()){
            $promotion_type = PromotionsService::getInstance()->getPromotionsById($pro_promo_check[0]->ppr_promotion_id);
        }else{
            $promotion_type = [];
        }
        $content_pro = ProductService::getInstance()->getContentPro($id);
        $prv_name = ProductService::getInstance()->getNameByPrvId($id);
        $prv_slug = ProductService::getInstance()->getSlugByProId($id);

        if (empty($pro_detail[0])) {
            $cate_id = 2;
        } else {
            $cate_id = $pro_detail[0]->pro_category_id;
        }
        //    lay anh san pham

        if ($prv_id == 0) {
            $pro_image_record = ImageService::getInstance()->getImages($id, $prv_id);
            // $image_pro = [];
            // foreach ($pro_image_record as $image) {
            //     $image_pro[] = $image->pri_name;
            // }
        } else if ($prv_id > 0) {
            $pro_image_record = ImageService::getInstance()->getImages($id, $prv_id);
        }



        // toi uu code
        $pro_slider = ProductService::getInstance()->getProSlider($cate_id);
        $pro_id_all = [];
        foreach ($pro_slider as $product) {
            $pro_id_all[] = [
                'pro_name' => $product->pro_name,
                'pro_id' => $product->pro_id,
                'pro_price' => $product->pro_price_sale,
                'pro_slug' => $product->pro_slug,
            ];
        }
        ;

        $prv_id_all = [];
        foreach ($pro_id_all as $prv_id) {
            $prv_id_all[] = [
                'pro_prv_id' => $prv_id,
                'prv_id' => ProductService::getInstance()->getPrvByProId($prv_id['pro_id']),
            ];
        }

        $image_all_arr = [];

        foreach ($prv_id_all as $image_pro) {
            $pro_id = $image_pro['pro_prv_id']['pro_id'];

            $pro_image_arr = ProductService::getInstance()->getImagePro($pro_id);

            $prv_image_arr = [];

            foreach ($image_pro['prv_id'] as $image_prv) {
                $prv_id = $image_prv->prv_id;
                $prv_image_arr[] = [
                    'pro_img_id' => $pro_id,
                    'prv_img_id' => $prv_id,
                    'prv_image_arr' => ProductService::getInstance()->getImagePrv($pro_id, $prv_id),
                ];
            }

            $image_all_arr[] = [
                'pro_img_all' => [
                    [
                        'pro_img_id_main' => $pro_id,
                        'pro_image_arr' => $pro_image_arr,
                    ],
                ],
                'prv_image_all' => $prv_image_arr,
            ];
        }



        $img_pro_final = []; // Khởi tạo mảng kết quả

        foreach ($image_all_arr as $img_arr) {
            $image_pro_all = []; // Khởi tạo mảng $image_pro_all cho mỗi vòng lặp
            $image_prv_all = []; // Khởi tạo mảng $image_prv_all cho mỗi vòng lặp

            foreach ($img_arr['pro_img_all'] as $img_pro) {
                foreach ($img_pro['pro_image_arr'] as $img_pro_detail) {
                    $image_pro_all[] = $img_pro_detail->pri_name;
                }
            }

            foreach ($img_arr['prv_image_all'] as $img_prv) {
                foreach ($img_prv['prv_image_arr'] as $img_prv_detail) {
                    $image_prv_all[] = $img_prv_detail->pri_name;
                }
            }

            $img_pro_final[] = [
                "img_pro" => $image_pro_all,
                'img_prv' => $image_prv_all,
            ];
        }

        $length_img = count($img_pro_final);
        $result_pro = [];
        $result_prv = [];
        for ($i = 0; $i < $length_img - 1; $i++) {
            $result_pro = array_merge($result_pro, $img_pro_final[$i]['img_pro']);
            $result_pro = array_unique($result_pro);
            $img_i = $img_pro_final[$i]['img_pro'];
            $img_i_next = $img_pro_final[$i + 1]['img_pro'];

            foreach ($img_i_next as $value) {
                $key = array_search($value, $result_pro);
                if ($key !== false) {
                    unset($img_i_next[$key]);
                }
            }
            $img_pro_final[$i + 1]['img_pro'] = array_values($img_i_next);

        }
        for ($i = 0; $i < $length_img - 1; $i++) {
            $result_prv = array_merge($result_prv, $img_pro_final[$i]['img_prv']);
            $result_prv = array_unique($result_prv);
            $img_i_prv = $img_pro_final[$i]['img_prv'];
            $img_i_prv_next = $img_pro_final[$i + 1]['img_prv'];

            foreach ($img_i_prv_next as $value) {
                $key = array_search($value, $result_prv);
                if ($key !== false) {
                    unset($img_i_prv_next[$key]);
                }
            }
            $img_pro_final[$i + 1]['img_prv'] = array_values($img_i_prv_next);

        }
        $count = count($img_pro_final);
        for ($i = 0; $i < $count; $i++) {
            $pro_chunk = array_chunk($img_pro_final[$i]['img_prv'], 4);
            unset($img_pro_final[$i]['img_prv']);
            $img_pro_final[$i]['img_prv'] = $pro_chunk;
        }
        for ($i = 0; $i < count($prv_id_all); $i++) {
            // Kiểm tra xem chỉ mục $i có tồn tại trong cả hai mảng không
            if (isset($prv_id_all[$i]) && isset($img_pro_final[$i])) {
                // Hợp nhất các phần tử tại chỉ mục $i từ cả hai mảng và đặt vào mảng 3
                $mergedArray = array_merge($prv_id_all[$i], $img_pro_final[$i]);
                $pro_info_final[] = $mergedArray;
            }
        }
        return view('product/detail_product', compact('pro_image_record', 'pro_detail', 'content_pro', 'pro_info_final', 'prv_name', 'prv_id', 'prv_slug', 'promotion_type'));
    }



    public function detailCategory($slug, $id)
    {
        $list_brand = ProductService::getInstance()->getBrandAll();
        $pro_cate = ProductService::getInstance()->getProCate($id);


// $pro_info_final = $pro_cate->map(function ($product) {
//     $pro_id = $product['pro_id'];

//     $pro_value = ProductService::getInstance()->getDetailProFilter($pro_id);
//     $prv_id = ProductService::getInstance()->getPrvByProId($pro_id);
//     $pro_image_arr = ProductService::getInstance()->getImagePro($pro_id);

//     $prv_image_arr = $prv_id->map(function ($prv) use ($pro_id) {
//         $prv_id = $prv->prv_id;
//         return [
//             'pro_img_id' => $pro_id,
//             'prv_img_id' => $prv_id,
//             'prv_image_arr' => ProductService::getInstance()->getImagePrv($pro_id, $prv_id),
//         ];
//     });

//     $img_pro = $pro_image_arr->pluck('pri_name')->unique()->values()->all();

//     $img_prv = $prv_image_arr->flatMap(function ($item) {
//         return $item['prv_image_arr']->pluck('pri_name')->all();
//     })->unique()->values()->all();

//     $img_prv_chunked = array_chunk($img_prv, 4);

//     return [
//         'pro_prv_id' => $pro_value,
//         'prv_id' => $prv_id,
//         'pro_img_all' => [
//             [
//                 'pro_img_id_main' => $pro_id,
//                 'pro_image_arr' => $img_pro,
//             ],
//         ],
//         'prv_image_all' => $img_prv_chunked,
//     ];
// });
        $pro_id_all = [];
        foreach ($pro_cate as $product) {
            $pro_id_all[] = [
                'pro_name' => $product->pro_name,
                'pro_id' => $product->pro_id,
                'pro_price' => $product->pro_price_sale,
                'pro_slug' => $product->pro_slug,
                'pro_created' => $product->pro_created_at,
            ];
        }
        ;

        $prv_id_all = [];
        foreach ($pro_id_all as $prv_id) {
            $prv_id_all[] = [
                'pro_prv_id' => $prv_id,
                'prv_id' => ProductService::getInstance()->getPrvByProId($prv_id['pro_id']),
            ];
        }

        $image_all_arr = [];

        foreach ($prv_id_all as $image_pro) {
            $pro_id = $image_pro['pro_prv_id']['pro_id'];

            $pro_image_arr = ProductService::getInstance()->getImagePro($pro_id);

            $prv_image_arr = [];

            foreach ($image_pro['prv_id'] as $image_prv) {
                $prv_id = $image_prv->prv_id;
                $prv_image_arr[] = [
                    'pro_img_id' => $pro_id,
                    'prv_img_id' => $prv_id,
                    'prv_image_arr' => ProductService::getInstance()->getImagePrv($pro_id, $prv_id),
                ];
            }

            $image_all_arr[] = [
                'pro_img_all' => [
                    [
                        'pro_img_id_main' => $pro_id,
                        'pro_image_arr' => $pro_image_arr,
                    ],
                ],
                'prv_image_all' => $prv_image_arr,
            ];
        }



        $img_pro_final = []; // Khởi tạo mảng kết quả

        foreach ($image_all_arr as $img_arr) {
            $image_pro_all = []; // Khởi tạo mảng $image_pro_all cho mỗi vòng lặp
            $image_prv_all = []; // Khởi tạo mảng $image_prv_all cho mỗi vòng lặp

            foreach ($img_arr['pro_img_all'] as $img_pro) {
                foreach ($img_pro['pro_image_arr'] as $img_pro_detail) {
                    $image_pro_all[] = $img_pro_detail->pri_name;
                }
            }

            foreach ($img_arr['prv_image_all'] as $img_prv) {
                foreach ($img_prv['prv_image_arr'] as $img_prv_detail) {
                    $image_prv_all[] = $img_prv_detail->pri_name;
                }
            }

            $img_pro_final[] = [
                "img_pro" => $image_pro_all,
                'img_prv' => $image_prv_all,
            ];
        }


        $length_img = count($img_pro_final);
        $result_pro = [];
        $result_prv = [];
        for ($i = 0; $i < $length_img - 1; $i++) {
            $result_pro = array_merge($result_pro, $img_pro_final[$i]['img_pro']);
            $result_pro = array_unique($result_pro);
            $img_i = $img_pro_final[$i]['img_pro'];
            $img_i_next = $img_pro_final[$i + 1]['img_pro'];

            foreach ($img_i_next as $value) {
                $key = array_search($value, $result_pro);
                if ($key !== false) {
                    unset($img_i_next[$key]);
                }
            }
            $img_pro_final[$i + 1]['img_pro'] = array_values($img_i_next);

        }

        for ($i = 0; $i < $length_img - 1; $i++) {
            $result_prv = array_merge($result_prv, $img_pro_final[$i]['img_prv']);
            $result_prv = array_unique($result_prv);
            $img_i_prv = $img_pro_final[$i]['img_prv'];
            $img_i_prv_next = $img_pro_final[$i + 1]['img_prv'];

            foreach ($img_i_prv_next as $value) {
                $key = array_search($value, $result_prv);
                if ($key !== false) {
                    unset($img_i_prv_next[$key]);
                }
            }
            $img_pro_final[$i + 1]['img_prv'] = array_values($img_i_prv_next);

        }


        $count = count($img_pro_final);

        for ($i = 0; $i < $count; $i++) {
            $pro_chunk = array_chunk($img_pro_final[$i]['img_prv'], 4);
            unset($img_pro_final[$i]['img_prv']);
            $img_pro_final[$i]['img_prv'] = $pro_chunk;
        }


        for ($i = 0; $i < count($prv_id_all); $i++) {
            // Kiểm tra xem chỉ mục $i có tồn tại trong cả hai mảng không
            if (isset($prv_id_all[$i]) && isset($img_pro_final[$i])) {
                // Hợp nhất các phần tử tại chỉ mục $i từ cả hai mảng và đặt vào mảng 3
                $mergedArray = array_merge($prv_id_all[$i], $img_pro_final[$i]);
                $pro_info_final[] = $mergedArray;
            }
        }

        $pro_count = $pro_cate->total();
        $count_pages = $pro_cate->lastPage();
        session(['pro_count' => $pro_count]);
        session(['count_pages' => $count_pages]);
        return view('category/category', compact('pro_info_final', 'id', 'list_brand'));
    }
    
    public function getPagesLoad($slug, $id){
        $pro_cate = ProductService::getInstance()->getProCate($id);
        $pro_id_all = [];
        foreach ($pro_cate as $product) {
            $pro_id_all[] = [
                'pro_name' => $product->pro_name,
                'pro_id' => $product->pro_id,
                'pro_price' => $product->pro_price_sale,
                'pro_slug' => $product->pro_slug,
            ];
        };

        $prv_id_all = [];
        foreach ($pro_id_all as $prv_id) {
            $prv_id_all[] = [
                'pro_prv_id' => $prv_id,
                'prv_id' => ProductService::getInstance()->getPrvByProId($prv_id['pro_id']),
            ];
        }

        $image_all_arr = [];

        foreach ($prv_id_all as $image_pro) {
            $pro_id = $image_pro['pro_prv_id']['pro_id'];

            $pro_image_arr = ProductService::getInstance()->getImagePro($pro_id);

            $prv_image_arr = [];

            foreach ($image_pro['prv_id'] as $image_prv) {
                $prv_id = $image_prv->prv_id;
                $prv_image_arr[] = [
                    'pro_img_id' => $pro_id,
                    'prv_img_id' => $prv_id,
                    'prv_image_arr' => ProductService::getInstance()->getImagePrv($pro_id, $prv_id),
                ];
            }

            $image_all_arr[] = [
                'pro_img_all' => [
                    [
                        'pro_img_id_main' => $pro_id,
                        'pro_image_arr' => $pro_image_arr,
                    ],
                ],
                'prv_image_all' => $prv_image_arr,
            ];
        }



        $img_pro_final = []; // Khởi tạo mảng kết quả

        foreach ($image_all_arr as $img_arr) {
            $image_pro_all = []; // Khởi tạo mảng $image_pro_all cho mỗi vòng lặp
            $image_prv_all = []; // Khởi tạo mảng $image_prv_all cho mỗi vòng lặp

            foreach ($img_arr['pro_img_all'] as $img_pro) {
                foreach ($img_pro['pro_image_arr'] as $img_pro_detail) {
                    $image_pro_all[] = $img_pro_detail->pri_name;
                }
            }

            foreach ($img_arr['prv_image_all'] as $img_prv) {
                foreach ($img_prv['prv_image_arr'] as $img_prv_detail) {
                    $image_prv_all[] = $img_prv_detail->pri_name;
                }
            }

            $img_pro_final[] = [
                "img_pro" => $image_pro_all,
                'img_prv' => $image_prv_all,
            ];
        }


        $length_img = count($img_pro_final);
        $result_pro = [];
        $result_prv = [];
        for ($i = 0; $i < $length_img - 1; $i++) {
            $result_pro = array_merge($result_pro, $img_pro_final[$i]['img_pro']);
            $result_pro = array_unique($result_pro);
            $img_i = $img_pro_final[$i]['img_pro'];
            $img_i_next = $img_pro_final[$i + 1]['img_pro'];

            foreach ($img_i_next as $value) {
                $key = array_search($value, $result_pro);
                if ($key !== false) {
                    unset($img_i_next[$key]);
                }
            }
            $img_pro_final[$i + 1]['img_pro'] = array_values($img_i_next);

        }

        for ($i = 0; $i < $length_img - 1; $i++) {
            $result_prv = array_merge($result_prv, $img_pro_final[$i]['img_prv']);
            $result_prv = array_unique($result_prv);
            $img_i_prv = $img_pro_final[$i]['img_prv'];
            $img_i_prv_next = $img_pro_final[$i + 1]['img_prv'];

            foreach ($img_i_prv_next as $value) {
                $key = array_search($value, $result_prv);
                if ($key !== false) {
                    unset($img_i_prv_next[$key]);
                }
            }
            $img_pro_final[$i + 1]['img_prv'] = array_values($img_i_prv_next);

        }


        $count = count($img_pro_final);

        for ($i = 0; $i < $count; $i++) {
            $pro_chunk = array_chunk($img_pro_final[$i]['img_prv'], 4);
            unset($img_pro_final[$i]['img_prv']);
            $img_pro_final[$i]['img_prv'] = $pro_chunk;
        }


        for ($i = 0; $i < count($prv_id_all); $i++) {
            // Kiểm tra xem chỉ mục $i có tồn tại trong cả hai mảng không
            if (isset($prv_id_all[$i]) && isset($img_pro_final[$i])) {
                // Hợp nhất các phần tử tại chỉ mục $i từ cả hai mảng và đặt vào mảng 3
                $mergedArray = array_merge($prv_id_all[$i], $img_pro_final[$i]);
                $pro_info_final[] = $mergedArray;
            }
        }
        return view('category/category_load', compact('pro_info_final'));
    }



    public function filterProduct(request $request){
        $pop_value    = ProductService::getInstance()->getProOptions(8);
        $cat_id = $request->catId;
        $order_value = $request->orderValue;
        $filter_type = $request->filterType;
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        $order_type = $request->orderType;
        $material = $request->valueMaterial;
        $material_id = $request->valueMaterialId;
        $format = $request->valueFormat;
        $format_id = $request->valueFormatId;
        $brand_value = $request->brandValue;
        $current_page = $request->currentPages;

        if(isset($material)){
        if (count($material) === 1 && $material[0] === null) {
            $material = [];
        } else {
        }
        }
        if(isset($format)){
        if (count($format) === 1 && $format[0] === null) {
            $format = [];
        } else {
        }}
        if(isset($brand_value)){
        if (count($brand_value) === 1 && $brand_value[0] === null) {
            $brand_value = [];
        } else {
        }}
        if($order_type == '0' && $filter_type == '1'){
            if(!empty($material) && empty($format) && empty($brand_value)){
                $list_pro_id =  ProductService::getInstance()->filterMaterialMany($material, $material_id);
                    $list_pro = [];
                    $list_pro = $list_pro_id->map(function ($value)  use ($cat_id, $minPrice, $maxPrice) {
                        $pro_value = ProductService::getInstance()->getDetailProFilter($value->pat_product_id, $cat_id);
                        return ['pro_value' => $pro_value];
                    })->filter(function ($product) {
                        return !$product['pro_value']->isEmpty();
                    })->map(function ($product) {
                        $pro_value = $product['pro_value'][0];
                        return [
                            'pro_name' => $pro_value->pro_name,
                            'pro_id' => $pro_value->pro_id,
                            'pro_price' => $pro_value->pro_price_sale,
                            'pro_slug' => $pro_value->pro_slug,
                            'pro_cate_id' => $pro_value->pro_category_id,
                        ];
                    })->whereBetween('pro_price', [$minPrice, $maxPrice]);

            } else if(!empty($material) && !empty($format) && empty($brand_value)){
                $list_pro_material =  ProductService::getInstance()->filterMaterialMany($material, $material_id);
                $list_pro_format =  ProductService::getInstance()->filterMaterialMany($format, $format_id);
                $pro_list_merge =  $list_pro_format->concat($list_pro_material);
                $list_pro = $pro_list_merge->unique('pat_product_id');
                $list_pro_id_value = $list_pro->values();
                    $list_pro_id = $list_pro_id_value->map(function ($value, $key)  use ($cat_id, $minPrice, $maxPrice) {
                        return [
                            'pro_value' => ProductService::getInstance()->getDetailProFilter($value->pat_product_id, $cat_id),
                        ];
                    });
                $pro_id_all_map = $list_pro_id->filter(function ($item) {
                    return $item['pro_value']->isNotEmpty();
                });
                $list_pro = $pro_id_all_map->map(function ($item) {
                    return [
                    'pro_name' => $item['pro_value'][0]->pro_name,
                    'pro_id' => $item['pro_value'][0]->pro_id,
                    'pro_price' => $item['pro_value'][0]->pro_price_sale,
                    'pro_slug' => $item['pro_value'][0]->pro_slug,
                    'pro_cate_id' =>  $item['pro_value'][0]->pro_category_id,
                ];
                })->whereBetween('pro_price',[$minPrice, $maxPrice]);

            }else if(empty($material) && !empty($format) && empty($brand_value)){
                $list_pro_id =  ProductService::getInstance()->filterMaterialMany($format, $format_id);
                $list_pro = [];
                $list_pro = $list_pro_id->map(function ($value) use ($cat_id) {
                        $pro_value = ProductService::getInstance()->getDetailProFilter($value->pat_product_id, $cat_id);
                        return ['pro_value' => $pro_value];
                    })->filter(function ($product) {
                        return !$product['pro_value']->isEmpty();
                    })->map(function ($product) {
                        $pro_value = $product['pro_value'][0];
                        return [
                            'pro_name' => $pro_value->pro_name,
                            'pro_id' => $pro_value->pro_id,
                            'pro_price' => $pro_value->pro_price_sale,
                            'pro_slug' => $pro_value->pro_slug,
                            'pro_cate_id' => $pro_value->pro_category_id,
                        ];
                    })->whereBetween('pro_price',[$minPrice, $maxPrice]);
            }else if(empty($material) && !empty($format) && !empty($brand_value)){
                $list_pro_id =  ProductService::getInstance()->filterMaterialMany($format, $format_id);
                $list_pro = [];
                    $list_pro = $list_pro_id->map(function ($value)  use ($cat_id, $minPrice, $maxPrice) {
                        $pro_value = ProductService::getInstance()->getDetailProFilter($value->pat_product_id, $cat_id);
                        return ['pro_value' => $pro_value];
                    })->filter(function ($product) {
                        return !$product['pro_value']->isEmpty();
                    })->map(function ($product) {
                        $pro_value = $product['pro_value'][0];
                        return [
                            'pro_name' => $pro_value->pro_name,
                            'pro_id' => $pro_value->pro_id,
                            'pro_price' => $pro_value->pro_price_sale,
                            'pro_slug' => $pro_value->pro_slug,
                            'pro_cate_id' => $pro_value->pro_category_id,
                            'pro_brand' => $pro_value->pro_brand_id,
                        ];
                    })->whereIn('pro_brand', $brand_value)->whereBetween('pro_price',[$minPrice, $maxPrice]);                

            }else if(!empty($material) && empty($format) && !empty($brand_value)){
                $list_pro_id =  ProductService::getInstance()->filterMaterialMany($material, $material_id);
                $list_pro = [];
                    $list_pro = $list_pro_id->map(function ($value)  use ($cat_id, $minPrice, $maxPrice) {
                        $pro_value = ProductService::getInstance()->getDetailProFilter($value->pat_product_id, $cat_id);
                        return ['pro_value' => $pro_value];
                    })->filter(function ($product) {
                        return !$product['pro_value']->isEmpty();
                    })->map(function ($product) {
                        $pro_value = $product['pro_value'][0];
                        return [
                            'pro_name' => $pro_value->pro_name,
                            'pro_id' => $pro_value->pro_id,
                            'pro_price' => $pro_value->pro_price_sale,
                            'pro_slug' => $pro_value->pro_slug,
                            'pro_cate_id' => $pro_value->pro_category_id,
                            'pro_brand' => $pro_value->pro_brand_id,
                        ];
                    })->whereIn('pro_brand', $brand_value)->whereBetween('pro_price',[$minPrice, $maxPrice]);


            }else if(empty($material) && empty($format) && !empty($brand_value)){
                $pro_value = ProductService::getInstance()->getProByBrand($brand_value, $cat_id);
                $list_pro = $pro_value->map(function($value){
                        return [
                            'pro_name' => $value->pro_name,
                            'pro_id' => $value->pro_id,
                            'pro_price' => $value->pro_price_sale,
                            'pro_slug' => $value->pro_slug,
                            'pro_cate_id' => $value->pro_category_id,
                        ];
                    })->whereBetween('pro_price',[$minPrice, $maxPrice]);
            }
            else if(!empty($material) && !empty($format) && !empty($brand_value)){
                $list_pro_material =  ProductService::getInstance()->filterMaterialMany($material, $material_id);
                $list_pro_format =  ProductService::getInstance()->filterMaterialMany($format, $format_id);
                $pro_list_merge =  $list_pro_format->concat($list_pro_material);
                $list_pro = $pro_list_merge->unique('pat_product_id');
                $list_pro_id_value = $list_pro->values();
                    $list_pro_id = $list_pro_id_value->map(function ($value, $key)  use ($cat_id, $minPrice, $maxPrice) {
                        return [
                            'pro_value' => ProductService::getInstance()->getDetailProFilter($value->pat_product_id, $cat_id),
                        ];
                    });

                $pro_id_all_map = $list_pro_id->filter(function ($item) {
                    return $item['pro_value']->isNotEmpty();
                });
                $list_pro = $pro_id_all_map->map(function ($item) {
                    return [
                    'pro_name' => $item['pro_value'][0]->pro_name,
                    'pro_id' => $item['pro_value'][0]->pro_id,
                    'pro_price' => $item['pro_value'][0]->pro_price_sale,
                    'pro_slug' => $item['pro_value'][0]->pro_slug,
                    'pro_cate_id' =>  $item['pro_value'][0]->pro_category_id,
                    'pro_brand' => $item['pro_value'][0]->pro_brand_id,
                ];
                })->whereIn('pro_brand', $brand_value)->whereBetween('pro_price',[$minPrice, $maxPrice]);;
            }
            else if(empty($material) && empty($format) && empty($brand_value)){
                $pro_cate = ProductService::getInstance()->proFilter($cat_id, $minPrice, $maxPrice);
                $list_pro = [];
                foreach ($pro_cate as $product) {
                    $list_pro[] = [
                        'pro_name' => $product->pro_name,
                        'pro_id' => $product->pro_id,
                        'pro_price' => $product->pro_price_sale,
                        'pro_slug' => $product->pro_slug,
                    ];
                };
            }
        }else if($order_type == "1" && $filter_type == '1'){
            //order_type = 1 
           if(!empty($material) && empty($format) && empty($brand_value)){
                $list_pro_id =  ProductService::getInstance()->filterMaterialMany($material, $material_id);
                $list_pro = [];
                    $list_pro = $list_pro_id->map(function ($value)  use ($cat_id, $minPrice, $maxPrice) {
                        $pro_value = ProductService::getInstance()->getDetailProFilter($value->pat_product_id, $cat_id);

                        return ['pro_value' => $pro_value];
                    })->filter(function ($product) {
                        return !$product['pro_value']->isEmpty();
                    })->map(function ($product) {
                        $pro_value = $product['pro_value'][0];
                        return [
                            'pro_name' => $pro_value->pro_name,
                            'pro_id' => $pro_value->pro_id,
                            'pro_price' => $pro_value->pro_price_sale,
                            'pro_slug' => $pro_value->pro_slug,
                            'pro_cate_id' => $pro_value->pro_category_id,
                        ];
                    })->whereBetween('pro_price',[$minPrice, $maxPrice]);

            } else if(!empty($material) && !empty($format) && empty($brand_value)){
                $list_pro_material =  ProductService::getInstance()->filterMaterialMany($material, $material_id);
                $list_pro_format =  ProductService::getInstance()->filterMaterialMany($format, $format_id);
                $pro_list_merge =  $list_pro_format->concat($list_pro_material);
                $list_pro = $pro_list_merge->unique('pat_product_id');
                $list_pro_id_value = $list_pro->values();
                    $list_pro_id = $list_pro_id_value->map(function ($value, $key)  use ($cat_id, $minPrice, $maxPrice) {
                        return [
                            'pro_value' => ProductService::getInstance()->getDetailProFilter($value->pat_product_id, $cat_id),
                        ];
                    });
                $pro_id_all_map = $list_pro_id->filter(function ($item) {
                    return $item['pro_value']->isNotEmpty();
                });
                $list_pro = $pro_id_all_map->map(function ($item) {
                    return [
                    'pro_name' => $item['pro_value'][0]->pro_name,
                    'pro_id' => $item['pro_value'][0]->pro_id,
                    'pro_price' => $item['pro_value'][0]->pro_price_sale,
                    'pro_slug' => $item['pro_value'][0]->pro_slug,
                    'pro_cate_id' =>  $item['pro_value'][0]->pro_category_id,
                ];
                })->whereBetween('pro_price',[$minPrice, $maxPrice]);

            }else if(empty($material) && !empty($format) && empty($brand_value)){
                $list_pro_id =  ProductService::getInstance()->filterMaterialMany($format, $format_id);
                $list_pro = [];
                    $list_pro = $list_pro_id->map(function ($value)  use ($cat_id, $minPrice, $maxPrice) {
                        $pro_value = ProductService::getInstance()->getDetailProFilter($value->pat_product_id, $cat_id);

                        return ['pro_value' => $pro_value];
                    })->filter(function ($product) {
                        return !$product['pro_value']->isEmpty();
                    })->map(function ($product) {
                        $pro_value = $product['pro_value'][0];
                        return [
                            'pro_name' => $pro_value->pro_name,
                            'pro_id' => $pro_value->pro_id,
                            'pro_price' => $pro_value->pro_price_sale,
                            'pro_slug' => $pro_value->pro_slug,
                            'pro_cate_id' => $pro_value->pro_category_id,
                        ];
                    })->whereBetween('pro_price',[$minPrice, $maxPrice]);

            }else if(empty($material) && !empty($format) && !empty($brand_value)){
                $list_pro_id =  ProductService::getInstance()->filterMaterialMany($format, $format_id);
                $list_pro = [];
                    $list_pro = $list_pro_id->map(function ($value)  use ($cat_id, $minPrice, $maxPrice) {
                        $pro_value = ProductService::getInstance()->getDetailProFilter($value->pat_product_id, $cat_id);
                        return ['pro_value' => $pro_value];
                    })->filter(function ($product) {
                        return !$product['pro_value']->isEmpty();
                    })->map(function ($product) {
                        $pro_value = $product['pro_value'][0];
                        return [
                            'pro_name' => $pro_value->pro_name,
                            'pro_id' => $pro_value->pro_id,
                            'pro_price' => $pro_value->pro_price_sale,
                            'pro_slug' => $pro_value->pro_slug,
                            'pro_cate_id' => $pro_value->pro_category_id,
                            'pro_brand' => $pro_value->pro_brand_id,
                        ];
                    })->whereIn('pro_brand', $brand_value)->whereBetween('pro_price',[$minPrice, $maxPrice]);
                
            }else if(!empty($material) && empty($format) && !empty($brand_value)){
                $list_pro_id =  ProductService::getInstance()->filterMaterialMany($material, $material_id);
                $list_pro = [];
                    $list_pro = $list_pro_id->map(function ($value)  use ($cat_id) {
                        $pro_value = ProductService::getInstance()->getDetailProFilter($value->pat_product_id, $cat_id);

                        return ['pro_value' => $pro_value];
                    })->filter(function ($product) {
                        return !$product['pro_value']->isEmpty();
                    })->map(function ($product) {
                        $pro_value = $product['pro_value'][0];
                        return [
                            'pro_name' => $pro_value->pro_name,
                            'pro_id' => $pro_value->pro_id,
                            'pro_price' => $pro_value->pro_price_sale,
                            'pro_slug' => $pro_value->pro_slug,
                            'pro_cate_id' => $pro_value->pro_category_id,
                            'pro_brand' => $pro_value->pro_brand_id,
                        ];
                    })->whereIn('pro_brand', $brand_value)->whereBetween('pro_price',[$minPrice, $maxPrice]);
            }
            else if(empty($material) && empty($format) && !empty($brand_value)){
                $pro_value = ProductService::getInstance()->getProByBrand($brand_value, $cat_id);
                $list_pro = $pro_value->map(function($value){
                        return [
                            'pro_name' => $value->pro_name,
                            'pro_id' => $value->pro_id,
                            'pro_price' => $value->pro_price_sale,
                            'pro_slug' => $value->pro_slug,
                            'pro_cate_id' => $value->pro_category_id,
                            'pro_brand' => $value->pro_brand_id,
                        ];
                    })->whereBetween('pro_price',[$minPrice, $maxPrice]);
            }
            else if(!empty($material) && !empty($format) && !empty($brand_value)){
                $list_pro_material =  ProductService::getInstance()->filterMaterialMany($material, $material_id);
                $list_pro_format =  ProductService::getInstance()->filterMaterialMany($format, $format_id);
                $pro_list_merge =  $list_pro_format->concat($list_pro_material);
                $list_pro = $pro_list_merge->unique('pat_product_id');
                $list_pro_id_value = $list_pro->values();
                    $list_pro_id = $list_pro_id_value->map(function ($value, $key)  use ($cat_id, $minPrice, $maxPrice) {
                        return [
                            'pro_value' => ProductService::getInstance()->getDetailProFilter($value->pat_product_id, $cat_id),
                        ];
                    });
                $pro_id_all_map = $list_pro_id->filter(function ($item) {
                    return $item['pro_value']->isNotEmpty();
                });
                $list_pro = $pro_id_all_map->map(function ($item) {
                    return [
                    'pro_name' => $item['pro_value'][0]->pro_name,
                    'pro_id' => $item['pro_value'][0]->pro_id,
                    'pro_price' => $item['pro_value'][0]->pro_price_sale,
                    'pro_slug' => $item['pro_value'][0]->pro_slug,
                    'pro_cate_id' =>  $item['pro_value'][0]->pro_category_id,
                    'pro_brand' => $item['pro_value'][0]->pro_brand_id,
                ];
                })->whereIn('pro_brand', $brand_value)->whereBetween('pro_price',[$minPrice, $maxPrice]);
                
            }
            else if(empty($material) && empty($format) && empty($brand_value)){
                $pro_cate = ProductService::getInstance()->orderProFilter($cat_id, $minPrice, $maxPrice, $order_value);

                $list_pro = [];
                foreach ($pro_cate as $product) {
                    $list_pro[] = [
                        'pro_name' => $product->pro_name,
                        'pro_id' => $product->pro_id,
                        'pro_price' => $product->pro_price_sale,
                        'pro_slug' => $product->pro_slug,
                    ];
                };
            }
            if($order_value == "asc"){
                $list_pro = $list_pro->sortBy('pro_price');
            }else if($order_value == "desc"){
                $list_pro = $list_pro->sortByDesc('pro_price');
            }else if($order_value == "new"){
                $list_pro = $list_pro->sortByDesc('new');
            }
        }else if($order_type == "1" && $filter_type == '0' ){
            if($order_value == 'asc'){
                $list_pro_id = ProductService::getInstance()->orderProAsc($cat_id)->get();
            }else if($order_value == 'desc'){
                $list_pro_id = ProductService::getInstance()->orderProDesc($cat_id)->get();
            }else if($order_value == 'new'){
                $list_pro_id = ProductService::getInstance()->orderProNew($cat_id)->get();
            }
            $list_pro = [];
                foreach ($list_pro_id as $product) {
                    $list_pro[] = [
                        'pro_name' => $product->pro_name,
                        'pro_id' => $product->pro_id,
                        'pro_price' => $product->pro_price_sale,
                        'pro_slug' => $product->pro_slug,
                    ];
                };
        };
        $prv_id_all = [];
        foreach ($list_pro as $prv_id) {
            $prv_id_all[] = [
                'pro_prv_id' => $prv_id,
                'prv_id' => ProductService::getInstance()->getPrvByProId($prv_id['pro_id']),
            ];
        }

        $image_all_arr = [];

        foreach ($prv_id_all as $image_pro) {
            $pro_id = $image_pro['pro_prv_id']['pro_id'];

            $pro_image_arr = ProductService::getInstance()->getImagePro($pro_id);

            $prv_image_arr = [];

            foreach ($image_pro['prv_id'] as $image_prv) {
                $prv_id = $image_prv->prv_id;
                $prv_image_arr[] = [
                    'pro_img_id' => $pro_id,
                    'prv_img_id' => $prv_id,
                    'prv_image_arr' => ProductService::getInstance()->getImagePrv($pro_id, $prv_id),
                ];
            }

            $image_all_arr[] = [
                'pro_img_all' => [
                    [
                        'pro_img_id_main' => $pro_id,
                        'pro_image_arr' => $pro_image_arr,
                    ],
                ],
                'prv_image_all' => $prv_image_arr,
            ];
        }



        $img_pro_final = []; // Khởi tạo mảng kết quả

        foreach ($image_all_arr as $img_arr) {
            $image_pro_all = []; // Khởi tạo mảng $image_pro_all cho mỗi vòng lặp
            $image_prv_all = []; // Khởi tạo mảng $image_prv_all cho mỗi vòng lặp

            foreach ($img_arr['pro_img_all'] as $img_pro) {
                foreach ($img_pro['pro_image_arr'] as $img_pro_detail) {
                    $image_pro_all[] = $img_pro_detail->pri_name;
                }
            }

            foreach ($img_arr['prv_image_all'] as $img_prv) {
                foreach ($img_prv['prv_image_arr'] as $img_prv_detail) {
                    $image_prv_all[] = $img_prv_detail->pri_name;
                }
            }

            $img_pro_final[] = [
                "img_pro" => $image_pro_all,
                'img_prv' => $image_prv_all,
            ];
        }


        $length_img = count($img_pro_final);
        $result_pro = [];
        $result_prv = [];
        for ($i = 0; $i < $length_img - 1; $i++) {
            $result_pro = array_merge($result_pro, $img_pro_final[$i]['img_pro']);
            $result_pro = array_unique($result_pro);
            $img_i = $img_pro_final[$i]['img_pro'];
            $img_i_next = $img_pro_final[$i + 1]['img_pro'];

            foreach ($img_i_next as $value) {
                $key = array_search($value, $result_pro);
                if ($key !== false) {
                    unset($img_i_next[$key]);
                }
            }
            $img_pro_final[$i + 1]['img_pro'] = array_values($img_i_next);
        }

        for ($i = 0; $i < $length_img - 1; $i++) {
            $result_prv = array_merge($result_prv, $img_pro_final[$i]['img_prv']);
            $result_prv = array_unique($result_prv);
            $img_i_prv = $img_pro_final[$i]['img_prv'];
            $img_i_prv_next = $img_pro_final[$i + 1]['img_prv'];

            foreach ($img_i_prv_next as $value) {
                $key = array_search($value, $result_prv);
                if ($key !== false) {
                    unset($img_i_prv_next[$key]);
                }
            }
            $img_pro_final[$i + 1]['img_prv'] = array_values($img_i_prv_next);
        }


        $count = count($img_pro_final);

        for ($i = 0; $i < $count; $i++) {
            $pro_chunk = array_chunk($img_pro_final[$i]['img_prv'], 4);
            unset($img_pro_final[$i]['img_prv']);
            $img_pro_final[$i]['img_prv'] = $pro_chunk;
        }


        for ($i = 0; $i < count($prv_id_all); $i++) {
            // Kiểm tra xem chỉ mục $i có tồn tại trong cả hai mảng không
            if (isset($prv_id_all[$i]) && isset($img_pro_final[$i])) {
                // Hợp nhất các phần tử tại chỉ mục $i từ cả hai mảng và đặt vào mảng 3
                $mergedArray = array_merge($prv_id_all[$i], $img_pro_final[$i]);
                $pro_info_final[] = $mergedArray;
            }
        }


        if(empty($pro_info_final)){
        if($order_type == "1" && $filter_type == '0' ){
                $page = [];
            return view('category/category_order', compact('page'));
         }else if($order_type == "0" && $filter_type == '1' ){
                $page = [];
            return view('category/category_filter', compact('page'));
         }else if($order_type == "1" && $filter_type == '1'){
                $page = [];
            return view('category/category_filter', compact('page', 'pop_value'));
         }
        }else{
        $pro_count = count($pro_info_final);
        $perPages = 9;
        $paginate = [];
        $page_count = 1;
        
        for ($i = 0; $i < count($pro_info_final); $i += $perPages ){
            $arr_item = array_slice($pro_info_final, $i, $perPages);
            $paginate[$page_count] = $arr_item;
            $page_count++;
        }
        $count_pages = count($paginate);
        session(['pro_count' => $pro_count]);
        session(['count_pages' => $count_pages]);
        session(['pop_value' => $pop_value]);
        if($current_page > 1){
            $pages = $paginate[$current_page];
            session(['current_pages' => $current_page]);
        }else{
            $pages= $paginate[1];
            session(['current_pages' => 1]);
        }
         if($order_type == "1" && $filter_type == '0'){
            return view('category/category_order', compact('pages'));
         }else if($order_type == "0" && $filter_type == '1'   || $order_type == "1" && $filter_type == '1'){
            return view('category/category_filter', compact('pages'));
         }
        }
}

public function searchProduct(request $request){
        $list_brand = ProductService::getInstance()->getBrandAll();
        $page = ($request->has('page')) ? $request->query('page') : 1;
        $query = ($request->has('query'))? $request->query('query'):"";
        $query      = ($page > 1) ? json_decode($query, true) : $query;
        $query = trim(strip_tags($query));
        $list_pro = ProductService::getInstance()->getProByQuery($query);
                $pro_id_all = [];
        foreach ($list_pro as $product) {
            $pro_id_all[] = [
                'pro_name' => $product->pro_name,
                'pro_id' => $product->pro_id,
                'pro_price' => $product->pro_price_sale,
                'pro_slug' => $product->pro_slug,
                'pro_created' => $product->pro_created_at,
            ];
        }
        ;

        $prv_id_all = [];
        foreach ($pro_id_all as $prv_id) {
            $prv_id_all[] = [
                'pro_prv_id' => $prv_id,
                'prv_id' => ProductService::getInstance()->getPrvByProId($prv_id['pro_id']),
            ];
        }

        $image_all_arr = [];

        foreach ($prv_id_all as $image_pro) {
            $pro_id = $image_pro['pro_prv_id']['pro_id'];

            $pro_image_arr = ProductService::getInstance()->getImagePro($pro_id);

            $prv_image_arr = [];

            foreach ($image_pro['prv_id'] as $image_prv) {
                $prv_id = $image_prv->prv_id;
                $prv_image_arr[] = [
                    'pro_img_id' => $pro_id,
                    'prv_img_id' => $prv_id,
                    'prv_image_arr' => ProductService::getInstance()->getImagePrv($pro_id, $prv_id),
                ];
            }

            $image_all_arr[] = [
                'pro_img_all' => [
                    [
                        'pro_img_id_main' => $pro_id,
                        'pro_image_arr' => $pro_image_arr,
                    ],
                ],
                'prv_image_all' => $prv_image_arr,
            ];
        }



        $img_pro_final = []; // Khởi tạo mảng kết quả

        foreach ($image_all_arr as $img_arr) {
            $image_pro_all = []; // Khởi tạo mảng $image_pro_all cho mỗi vòng lặp
            $image_prv_all = []; // Khởi tạo mảng $image_prv_all cho mỗi vòng lặp

            foreach ($img_arr['pro_img_all'] as $img_pro) {
                foreach ($img_pro['pro_image_arr'] as $img_pro_detail) {
                    $image_pro_all[] = $img_pro_detail->pri_name;
                }
            }

            foreach ($img_arr['prv_image_all'] as $img_prv) {
                foreach ($img_prv['prv_image_arr'] as $img_prv_detail) {
                    $image_prv_all[] = $img_prv_detail->pri_name;
                }
            }

            $img_pro_final[] = [
                "img_pro" => $image_pro_all,
                'img_prv' => $image_prv_all,
            ];
        }


        $length_img = count($img_pro_final);
        $result_pro = [];
        $result_prv = [];
        for ($i = 0; $i < $length_img - 1; $i++) {
            $result_pro = array_merge($result_pro, $img_pro_final[$i]['img_pro']);
            $result_pro = array_unique($result_pro);
            $img_i = $img_pro_final[$i]['img_pro'];
            $img_i_next = $img_pro_final[$i + 1]['img_pro'];

            foreach ($img_i_next as $value) {
                $key = array_search($value, $result_pro);
                if ($key !== false) {
                    unset($img_i_next[$key]);
                }
            }
            $img_pro_final[$i + 1]['img_pro'] = array_values($img_i_next);

        }

        for ($i = 0; $i < $length_img - 1; $i++) {
            $result_prv = array_merge($result_prv, $img_pro_final[$i]['img_prv']);
            $result_prv = array_unique($result_prv);
            $img_i_prv = $img_pro_final[$i]['img_prv'];
            $img_i_prv_next = $img_pro_final[$i + 1]['img_prv'];

            foreach ($img_i_prv_next as $value) {
                $key = array_search($value, $result_prv);
                if ($key !== false) {
                    unset($img_i_prv_next[$key]);
                }
            }
            $img_pro_final[$i + 1]['img_prv'] = array_values($img_i_prv_next);

        }


        $count = count($img_pro_final);

        for ($i = 0; $i < $count; $i++) {
            $pro_chunk = array_chunk($img_pro_final[$i]['img_prv'], 4);
            unset($img_pro_final[$i]['img_prv']);
            $img_pro_final[$i]['img_prv'] = $pro_chunk;
        }


        for ($i = 0; $i < count($prv_id_all); $i++) {
            // Kiểm tra xem chỉ mục $i có tồn tại trong cả hai mảng không
            if (isset($prv_id_all[$i]) && isset($img_pro_final[$i])) {
                // Hợp nhất các phần tử tại chỉ mục $i từ cả hai mảng và đặt vào mảng 3
                $mergedArray = array_merge($prv_id_all[$i], $img_pro_final[$i]);
                $pro_info_final[] = $mergedArray;
            }
        }

        $pro_count = $list_pro->total();
        $count_pages = $list_pro->lastPage();
        session(['pro_count' => $pro_count]);
        session(['count_pages' => $count_pages]);
        if($page > 1){
            return view('category/category_search_load', compact('pro_info_final', 'list_brand'));
        }else{
            return view('category/category_search', compact('pro_info_final', 'list_brand'));
        }

    }
}
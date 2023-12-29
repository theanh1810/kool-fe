<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Post;
use App\Models\ProductVariations;
use App\Models\Category;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = App::make('sitemap');
// add home pages mặc định
    $sitemap->add(env('APP_URL'), Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
    $sitemap->add(env('APP_URL')."/about-us", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
    $sitemap->add(env('APP_URL')."/gong-kinh-ci1", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
    $sitemap->add(env('APP_URL')."/gong-kinh-nam-ci2", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
    $sitemap->add(env('APP_URL')."/gong-kinh-nu-ci3", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
    $sitemap->add(env('APP_URL')."/gong-kinh-tre-em-ci5", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
    $sitemap->add(env('APP_URL')."/product-sale/ci1", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
    $sitemap->add(env('APP_URL')."/product-sale/ci2", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
    $sitemap->add(env('APP_URL')."/blog/tin-tuc-ci5", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
    $sitemap->add(env('APP_URL')."/blog/tin-tuc-ci8", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
    $sitemap->add(env('APP_URL')."/search-order", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
    $sitemap->add(env('APP_URL')."/purchase", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');    
    $sitemap->add(env('APP_URL')."/search-product", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');        
    $sitemap->add(env('APP_URL')."/search-warranty", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
    
    $list_pro_prv = [];
    $pro_id_list = Product::select("pro_id", "pro_slug")->get();
    foreach($pro_id_list as $key => $product){
            $list_pro_prv[$key] = [
                'pro_info'  => $product,
                'prv_info' => ProductVariations::select("prv_id")->where('prv_product_id', $product->pro_id)->get(),
            ];
    }
    foreach ($list_pro_prv as $key => $value) {
    if (!empty($value['prv_info'])) {
        foreach ($value['prv_info'] as $value_prv) {
        $sitemap->add(
            env('APP_URL') . "/" .$value['pro_info']->pro_slug."-pi" .$value['pro_info']->pro_id."?variant_id=" . $value_prv->prv_id,
            Carbon::now('Asia/Ho_Chi_Minh'),
            '0.7',
            'daily'
        );
        
    }
    }else{
        continue;
    }

       
    }

        $list_post = Post::select("pos_slug", "pos_id")->get();
        foreach($list_post as $post){
            $sitemap->add(env('APP_URL'). "/blog/" . $post->pos_slug . "pi" . $post->pos_id, Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }


// lưu file và phân quyền
$sitemap->store('xml', 'sitemap');
if (File::exists(public_path() . '/sitemap.xml')) {
            File::copy(public_path("sitemap.xml"), base_path('sitemap.xml'));
}
    }
}

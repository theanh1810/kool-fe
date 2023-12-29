<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\WarrantyService;

class CheckWarranty implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    { 
        $list_pro = WarrantyService::getInstance()->getAllProWarranty();
        if($list_pro->isEmpty()){
            return "Không tìm thấy sản phẩm bảo hành";
        } else {
        $time_now = time();
        $list_pro = $list_pro->filter(function($value, $key) use ($time_now) {
            return $value->war_to_time < $time_now;
        });
        $list_pro->each(function ($value) {
          WarrantyService::getInstance()->addStatusWarranty($value->war_product_id, $value->war_product_variation_id);
       });
      return "Success";
      };
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPromotions extends BaseModel
{
    protected $table = 'product_promotions';
    public $primaryKey  = 'ppr_id';

    public $timestamps = false;
}

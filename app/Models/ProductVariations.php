<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariations extends BaseModel
{
    protected $table = 'products_variations';
    public $primaryKey  = 'prv_id';

    public $timestamps = false;
}

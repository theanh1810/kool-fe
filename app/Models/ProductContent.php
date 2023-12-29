<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends BaseModel
{
    protected $table = 'product_images';
    public $primaryKey  = 'pri_id';

    public $timestamps = false;
}
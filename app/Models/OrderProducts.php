<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends BaseModel
{
    protected $table = 'order_products';
    public $primaryKey  = 'orp_id';

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends BaseModel
{
    protected $table = 'products';
    public $primaryKey  = 'pro_id';

    public $timestamps = false;
}

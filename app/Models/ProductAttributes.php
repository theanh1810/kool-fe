<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends BaseModel
{
    protected $table = 'product_attributes';
    public $primaryKey  = 'pat_id';

    public $timestamps = false;
}

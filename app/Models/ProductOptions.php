<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptions extends BaseModel
{
    protected $table = 'product_options';
    public $primaryKey  = 'pop_id';

    public $timestamps = false;
}

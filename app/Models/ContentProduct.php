<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentProduct extends BaseModel
{
    protected $table = 'product_contents';
    public $primaryKey  = 'prc_id';

    public $timestamps = false;
}

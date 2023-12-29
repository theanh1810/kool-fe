<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    protected $table = 'categories';
    public $primaryKey  = 'cat_id';

    public $timestamps = false;
}

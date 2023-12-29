<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotions extends BaseModel
{
    protected $table = 'promotions';
    public $primaryKey  = 'prm_id';

    public $timestamps = false;
}

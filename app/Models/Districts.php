<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends BaseModel
{
    protected $table = 'districts';
    public $primaryKey  = 'dis_id';

    public $timestamps = false;
}

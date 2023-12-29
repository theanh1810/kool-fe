<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends BaseModel
{
    protected $table = 'posts';
    public $primaryKey  = 'pos_id';

    public $timestamps = false;
}

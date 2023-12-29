<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends BaseModel
{
    protected $table = 'wards';
    public $primaryKey  = 'war_id';

    public $timestamps = false;
}

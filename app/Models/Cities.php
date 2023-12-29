<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends BaseModel
{
    protected $table = 'cities';
    public $primaryKey  = 'cit_id';

    public $timestamps = false;
}
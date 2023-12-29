<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $table = 'warranty';
    public $primaryKey  = 'war_id';
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends BaseModel
{
    protected $table = 'customers';
    protected $fillable = [
        'cus_phone',
        'cus_name',
        'cus_email',
        'cus_address',
        'cus_city_id',
        'cus_district_id',
        'cus_ward_id',
        'cus_sex'
    ];
    public $primaryKey  = 'cus_id';

    public $timestamps = false;
}

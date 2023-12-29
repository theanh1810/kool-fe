<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends BaseModel
{
    protected $table = 'orders';
    protected $fillable = [
        'ord_code',
        'ord_fullname',
        'ord_phone',
        'ord_email',
        'ord_sex',
        'ord_city_id',
        'ord_district_id',
        'ord_ward_id',
        'ord_address',
        'ord_product',
        'ord_money',
        'ord_discount',
        'ord_money_pay',
        'ord_create_at',
        'ord_customer_id'
    ];
    protected $casts = [
        'ord_ctv_id' => 'integer',
		'ord_fullname'		=> 'string',
		'ord_phone'			=> 'integer',
		'ord_email'			=> 'string',
		'ord_sex'			=> 'string',
		'ord_city_id'		=> 'integer',
		'ord_district_id'	=> 'integer',
		'ord_wards_id'		=> 'integer',
		'ord_address'		=> 'string',
		'ord_customer_id'	=>  'integer',
		'ord_money_pay'		=> 'double',
		'ord_code'			=>  'integer',
    ];
    protected $default_data = [
		'ord_ctv_id'		=> null,
		'ord_fullname'		=> null,
		'ord_phone'			=> null,
		'ord_email'			=> null,
		'ord_sex'			=> 0,
		'ord_city_id'		=> null,
		'ord_district_id'	=> null,
		'ord_wards_id'		=> null,
		'ord_address'		=> null,
		'ord_note'			=> null,
		'ord_created_at'	=> null,
		'ord_created_by'	=> null,
		'ord_discount'		=> null,
		'ord_money'			=> null,
		'products'			=> null,
		'ord_customer_id'	=> null,
		'ord_money_pay'		=> null,
		'ord_code'			=> null,
		'ord_created_at'    => null,
		'ord_staff_sale_id' => 0,
		'ord_source_id'		=> 0,
    ];
    public $primaryKey  = 'ord_id';

    public $timestamps = false;
}

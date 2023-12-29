<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
       'add-to-cart',
       "buy-now",
       'remove-cart',
       'filter',
       'order-cate',
       'get-district',
       'get-wards',
       'get-order',
       'gong-kinh-unisex-ci4',
       'gong-kinh-tre-em-ci5',
       'gong-kinh-nam-ci2',
       'gong-kinh-ci1',
       'gong-kinh-nu-ci3',
       'kinh-ram-ci7',
       'get-order-info',
       'product-sale/ci2',
       'product-sale/ci1',
       'change-cart',
       'search-product',
    ];
}

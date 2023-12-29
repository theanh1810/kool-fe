<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//trang chu
Route::group(['prefix' => '',], function () {
    // trang chu
    Route::get('', 'HomeController@index')->name("home");
});

//product
Route::group(['prefix' => '',], function () {
    Route::get('/{slug}-pi{id}', 'ProductController@detailProduct')->where(["slug"=> "[\w\-\_\.]+","id"=> "[\d]+"])->name('detail_product');
    Route::get('{slug}-ci{id}', 'ProductController@detailCategory')->where(["slug"=> "[\w\-\_\.]*","id"=> "[\d]*"])->name('category');
    Route::get('/sale-page', 'ProductController@detailSalePage')->where(["slug"=> "[\w\-\_\.]*","id"=> "[\d]*"]);
    Route::get('/{slug}-ci{id}/load', 'ProductController@getPagesLoad')->where(["slug"=> "[\w\-\_\.]*","id"=> "[\d]*"]);
    Route::any('/order-cate', 'ProductController@filterProduct');
    Route::any('/filter', 'ProductController@filterProduct');
});

// cart
Route::group(['prefix' => '',], function () {
  Route::any('/add-to-cart', 'CartController@addCart');
  Route::any('/buy-now', 'CartController@buyNow');
  Route::any('/remove-cart', 'CartController@removeCartItem');
  Route::any('/change-cart', 'CartController@changeCart');

    // Routes within this group will have the '/admin' prefix
});

//purchase
Route::group(['prefix' => '',], function () {
  Route::get('/purchase', 'OrderController@getCity')->where(["slug"=> "[\w\-\_\.]*","id"=> "[\d]*"])->name("purchase");
  Route::any('/get-district', 'OrderController@getDistrict');
  Route::any('/get-wards', 'OrderController@getWard');
  Route::any('/get-order', 'OrderController@addOrder');
  Route::get("/search-product", "ProductController@searchProduct");
  Route::get('/search-order', 'OrderController@detailSearchOrder');
  Route::get('/search-warranty', 'WarrantyController@index');
  Route::get('/get-info-order', 'OrderController@detailSearchInfor');
  Route::get('/get-info-warranty', 'WarrantyController@getWarranty');

});

//about-us
Route::group(['prefix' => '',], function () {
    Route::get('/about-us', 'HomeController@aboutUs');
});

//blog
Route::group(['prefix' => '',], function () {
    Route::get('/blog/{slug}ci{id}', 'BlogController@getPostCate');
    Route::get('/blog/{slug}pi{id}', 'BlogController@getDetailPost')->name("blog-detail");
});


//promotion
Route::group(['prefix' => '',], function () {
    Route::get('/product-sale/ci{id}', 'PromotionsController@detailPromotion');
    Route::post('/product-sale/ci{id}', 'PromotionsController@detailPromotion')->where(["slug"=> "[\w\-\_\.]*","id"=> "[\d]*"]);
});
    // ... other routes for the admin section

// Route::prefix('promotion')->group(function () {
//     // Routes within this group will have the '/admin' prefix
//     Route::get('/Promotion', 'PromotionController@index');
//     // ... other routes for the admin section
// });

// Route::prefix('page')->group(function () {
//     // Routes within this group will have the '/admin' prefix
//     Route::get('/pages', 'PageController@index');
//     // ... other routes for the admin section
// });

// Route::prefix('post')->group(function () {
//     // Routes within this group will have the '/admin' prefix
//     Route::get('/post', 'PostController@index');
//     // ... other routes for the admin section
// });

// Route::prefix('cart')->group(function () {
//     // Routes within this group will have the '/admin' prefix
//     Route::get('/cart', 'CartController@index');
//     // ... other routes for the admin section
// });

// Route::prefix('checkout')->group(function () {
//     // Routes within this group will have the '/admin' prefix
//     Route::get('/checkout', 'CheckoutController@index');
//     // ... other routes for the admin section
// });

// Route::prefix('checking')->group(function () {
//     // Routes within this group will have the '/admin' prefix
//     Route::get('/checking', 'CheckingController@index');
//     // ... other routes for the admin section
// });

// Route::prefix('check-info')->group(function () {
//     // Routes within this group will have the '/admin' prefix
//     Route::get('/check-info', 'CheckInfoController@index');
//     // ... other routes for the admin section
// });

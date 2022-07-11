<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::namespace('Api')->group(function() {
    Route::get("/list-province", "Order"."ApiController@getProvince");
    Route::get('/get-district/{id_tinh}', "Order"."ApiController@getDistrict");
    Route::get('/get-ward/{id_huyen}', "Order"."ApiController@getWard");
    Route::get('/get-shipping', 'OrderApiController@getShipping');
    Route::get('/get-address', 'OrderApiController@getAddress');
    Route::get('/check-coupon', 'OrderApiController@checkCoupon');
    Route::get('/check-logs', 'LogsApiController@checkLogs')->name('checkLogs');
    /* === blog === */
    $prefix = "news";
    Route::prefix($prefix)->group(function () {
        Route::get("/", "Blog"."ApiController@list");
        Route::get("/show/{id}", "Blog"."ApiController@show");
        Route::get("/category", "Blog"."ApiController@category");
        Route::get("/get_cate_by_id/{id}", "Blog"."ApiController@categoryShow");
    });
    /* === product === */
    $prefix = "products";
    Route::prefix($prefix)->group(function () {
        Route::get("/", "Product"."ApiController@list");
        Route::get("/product-detail/{slug_category}", "Product"."ApiController@show");
        Route::get("/productByCategory/{slug}", "Product"."ApiController@productListByCategory");
        Route::get("/category", "Product"."ApiController@category");
        Route::get("/get_cate_by_id/{id}", "Product"."ApiController@categoryShow");
    });
    /* === course === */
    $prefix = "courses";
    Route::prefix($prefix)->group(function () {
        Route::get("/", "Course"."ApiController@list");
        Route::get('/lesson-detail/{lesson}', "Course"."ApiController@lessionDetailChapter");
        Route::get('/course_by_category/{slug_category}', "Course"."ApiController@courseListInCategory");
        Route::get("/{slug_category}/{course_slug}", "Course"."ApiController@show");

        Route::get("/category", "Course"."ApiController@category");
        Route::get("/get_cate_by_id/{id}", "Course"."ApiController@categoryShow");

        Route::get('/course_by_tag/{slug}', "Course"."ApiController@courseTagSlug");
        Route::get('/search-course', "Course"."ApiController@search");
    });

    $prefix = "common";
    Route::prefix($prefix)->group(function () {
        Route::get("/slider", "Common"."ApiController@slider");
        Route::get("/event", "Common"."ApiController@event");
        Route::get("/event/detail/{id}", "Common"."ApiController@eventDetail");
        Route::get("/notification", "Common"."ApiController@notification");
        Route::get("/notification/detail/{id}", "Common"."ApiController@showNotification");
        Route::get("/question", "Common"."ApiController@question");
        Route::get("/question-client", "Common"."ApiController@questionClient");
        Route::post("/question-client/save", "Common"."ApiController@postquestionClient");
    });
    $prefix = "auth";
    Route::prefix($prefix)->group(function () {
        Route::post("/register", "User"."ApiController@postRegister");
        Route::post("/login", "User"."ApiController@login");
        Route::group([
            'middleware' => 'auth:api'
        ], function() {
            Route::post('/change-password', "Account"."ApiController@changePassword");
            Route::post("khoa-hoc/add-comment", "Course"."ApiController@addComment");
            Route::get('/logout', "User"."ApiController@logout");
            Route::get('/my-profile', "Account"."ApiController@myProfile");
            Route::get('/my-order-detail/{order_id}', "Account"."ApiController@myOrderDetail");
            Route::get('/my-courses', "Account"."ApiController@myCourses");
            Route::post('/change-profile', "Account"."ApiController@changeProfile");

            Route::post("khoa-hoc/add-comment", "Course"."ApiController@addComment");
            Route::post('/thanh-toan', "Order"."ApiController@postCheckout");
        });
    });
});


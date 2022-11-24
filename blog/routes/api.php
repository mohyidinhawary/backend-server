<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CourseController;
use App\Http\Controllers\api\ProductController;
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
Route::post("register",[UserController::class,"Register"]);
Route::post("login",[UserController::class,"Login"]);
Route::group(["middleware"=>["auth:api"]],function(){
    Route::get("user_profile",[UserController::class,"Profile"]);
    Route::get("logout",[UserController::class,"Logout"]);

// course api routes
Route::post("course-enroll",[CourseController::class,"CourseEnrollment"]);
Route::get("total-courses",[CourseController::class,"TotalCourses"]);
Route::get("delete-course/{id}",[CourseController::class,"DeleteCourse"]);
// product api routes
Route::post("product-enroll",[ProductController::class,"ProductEnrollment"]);
Route::get("total-products",[ProductController::class,"TotalProdcts"]);
Route::get("delete-product/{owner_email}",[ProductController::class,"DeleteProduct"]);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

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

Route::get('/', function () {
    return view('Dashboard.list');
})->name('home')->middleware('login');
// Signin
Route::get('admin_getLogin',[\App\Http\Controllers\AdminController::class,'getLogin'])->name('admin.getLogin');
Route::post('admin_postLogin',[\App\Http\Controllers\AdminController::class,'postLogin'])->name('admin.postLogin');
Route::get('admin_logout',[\App\Http\Controllers\AdminController::class,'logout'])->name('admin.logout');
// Signup
Route::get('admin_getSignup',[\App\Http\Controllers\AdminController::class,'getSignup'])->name('admin.getSignup');
Route::post('admin_postSignup',[\App\Http\Controllers\AdminController::class,'postSignup'])->name('admin.postSignup');
// Table
Route::middleware(['login'])->group(function (){
    Route::resource('/Rooms', RoomController::class);
    Route::resource('/RoomType', RoomTypeController::class);
    Route::resource('/Facility', FacilityController::class);
    Route::resource('/RoomFacility', RoomFacilityController::class);
    Route::resource('/Guest', GuestController::class);
    Route::get('/Guests', [\App\Http\Controllers\GuestController::class,'index2'])->name('Guest.index2');
});

Route::prefix('RoomImage')->group(function (){
    Route::get('/',[\App\Http\Controllers\RoomImageController::class,'index'])->name('RoomImage.index');
    Route::get('/add/{id}',[\App\Http\Controllers\RoomImageController::class,'add'])->name('RoomImage.add');
});

// BookRoom
Route::get('/BookRoom/{room_id}',[\App\Http\Controllers\BookingController::class,'index'])->name('BookRoom');
Route::post('/BookRoom_save/{room_id}',[\App\Http\Controllers\BookingController::class,'save'])->name('BookRoom.save');

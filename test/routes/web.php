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
    return view('admin.home');
})->name('home')->middleware('login');
// Signin
Route::get('admin_getLogin', [\App\Http\Controllers\AdminController::class, 'getLogin'])->name('admin.getLogin');
Route::post('admin_postLogin', [\App\Http\Controllers\AdminController::class, 'postLogin'])->name('admin.postLogin');
Route::get('admin_logout', [\App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
// Signup
Route::get('admin_getSignup', [\App\Http\Controllers\AdminController::class, 'getSignup'])->name('admin.getSignup');
Route::post('admin_postSignup', [\App\Http\Controllers\AdminController::class, 'postSignup'])->name('admin.postSignup');
// Table
Route::middleware(['login'])->group(function () {
    Route::resource('/Rooms', RoomController::class);
    Route::get('/Room_destroy_ajax/{id}',[\App\Http\Controllers\RoomController::class,'destroy_ajax'])->name('Room_destroy_ajax');

    Route::resource('/RoomType', RoomTypeController::class);
    Route::get('/RoomType_destroy_ajax/{id}',[\App\Http\Controllers\RoomTypeController::class,'destroy_ajax'])->name('RoomType_destroy_ajax');

    Route::resource('/Facility', FacilityController::class);
    Route::get('/Facility_destroy_ajax/{id}',[\App\Http\Controllers\FacilityController::class,'destroy_ajax'])->name('Facility_destroy_ajax');


    Route::resource('/RoomFacility', RoomFacilityController::class);

    Route::resource('/Guest', GuestController::class);
    Route::get('/Guest_destroy_ajax/{id}',[\App\Http\Controllers\GuestController::class,'destroy_ajax'])->name('Guest_destroy_ajax');

    Route::resource('/Slider', SliderController::class);
    Route::get('/Slider_destroy_ajax/{id}',[\App\Http\Controllers\SliderController::class,'destroy_ajax'])->name('Slider_destroy_ajax');

    Route::resource('/User', UserController::class);
    Route::get('/User_destroy_ajax/{id}',[\App\Http\Controllers\UserController::class,'destroy_ajax'])->name('User_destroy_ajax');

});

Route::prefix('RoomImage')->group(function () {
    Route::get('/', [\App\Http\Controllers\RoomImageController::class, 'index'])->name('RoomImage.index');
    Route::get('/add/{id}', [\App\Http\Controllers\RoomImageController::class, 'add'])->name('RoomImage.add');
});

//Guest
Route::get('/Guests', [\App\Http\Controllers\GuestController::class, 'index2'])->name('Guest.index2')->middleware('login');
// BookRoom
Route::get('/BookRoom/{room_id}', [\App\Http\Controllers\BookingController::class, 'index'])->name('BookRoom')->middleware('login');
Route::post('/BookRoom_save/{room_id}', [\App\Http\Controllers\BookingController::class, 'save'])->name('BookRoom.save')->middleware('login');
// Bookings
Route::get('/Booking', [\App\Http\Controllers\BookingController::class, 'index2'])->name('Booking.index2')->middleware('login');
Route::post('/Booking_destroy/{id}', [\App\Http\Controllers\BookingController::class, 'destroy'])->name('Booking.destroy')->middleware('login');
Route::get('/Booking_destroy_ajax/{id}',[\App\Http\Controllers\BookingController::class,'destroy_ajax'])->name('Booking_destroy_ajax')->middleware('login');

Route::post('/Booking_confirm/{booking_id}', [\App\Http\Controllers\BookingController::class, 'confirm'])->name('Booking.confirm')->middleware('login');
Route::post('/Booking_finish/{booking_id}', [\App\Http\Controllers\BookingController::class, 'finish'])->name('Booking.finish')->middleware('login');
Route::get('/Booking_finish_ajax/{id}',[\App\Http\Controllers\BookingController::class,'finish_ajax'])->name('Booking_finish_ajax');

Route::get('/Booking_printer/{id}', [\App\Http\Controllers\BookingController::class, 'printer'])->name('Booking.printer')->middleware('login');

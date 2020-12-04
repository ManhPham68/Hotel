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



Route::get('/',[\App\Http\Controllers\FrontendController::class,'index'])->name('frontend_index');
Route::get('/Roome_detail/{room_id}',[\App\Http\Controllers\FrontendController::class,'room_detail'])->name('Roome_detail');
Route::get('/Room_index_frontend',[\App\Http\Controllers\FrontendController::class,'lsRoom_index_frontend'])->name('Room_index_frontend');
Route::get('/Room_index_frontend2',[\App\Http\Controllers\FrontendController::class,'lsRoom_index_frontend2'])->name('Room_index_frontend2');
Route::get('/Room_Booking_search/{roombooking_id}',[\App\Http\Controllers\FrontendController::class,'Room_Booking_search'])->name('Room_Booking_search');
Route::get('/Room_BookingAll_search_next/{booking_id}',[\App\Http\Controllers\FrontendController::class,'Room_BookingAll_search_next'])->name('Room_BookingAll_search_next');

// BookRoom
Route::get('/BookRoom/{room_id}', [\App\Http\Controllers\BookingController::class, 'index'])->name('BookRoom');
Route::get('/BookRoom_next/{room_id}/{old_booking}', [\App\Http\Controllers\BookingController::class, 'index_next'])->name('BookRoom_next');
//Route::get('/fetch_data', 'PaginationController@fetch_data');
//Route::get('/fetch_data_next/{booking_id}', 'PaginationController@fetch_data_2');
Route::post('/BookRoom_save/{room_id}', [\App\Http\Controllers\BookingController::class, 'save'])->name('BookRoom.save');
Route::get('/BookRoom_accept/{booking_id}',[\App\Http\Controllers\BookingController::class,'save2'])->name('BookRoom_accept');



Route::get('/admin_home', function () {
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
    Route::resource('/Role', RoleController::class);
    Route::get('/Role_delete_ajax/{id}', [\App\Http\Controllers\RoleController::class,'destroy_ajax'])->name('Role_delete_ajax');

    Route::resource('/Rooms', RoomController::class);
    Route::get('/fetch_data_list_room_table/{room_type_name}', 'PaginationController@fetch_data_list_room_table')->name('fetch_data_list_room_table.index');

    Route::get('/Room_destroy_ajax/{id}',[\App\Http\Controllers\RoomController::class,'destroy_ajax'])->name('Room_destroy_ajax');
    Route::get('/Room_Booking',[\App\Http\Controllers\RoomController::class,'index2'])->name('Room_Booking');
    Route::get('/Room_Booked',[\App\Http\Controllers\RoomController::class,'index3'])->name('Room_Booked');
    Route::get('/Room_Finish_Booking',[\App\Http\Controllers\RoomController::class,'index4'])->name('Room_Finish_Booking');

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

    Route::get('Permission.add',[\App\Http\Controllers\PermissionController::class,'create'])->name('Permission.add');
    Route::post('Permission.store',[\App\Http\Controllers\PermissionController::class,'store'])->name('Permission.store');

    Route::prefix('RoomImage')->group(function () {
        Route::get('/', [\App\Http\Controllers\RoomImageController::class, 'index'])->name('RoomImage.index');
    });

});


//Guest
Route::get('/Guests', [\App\Http\Controllers\GuestController::class, 'index2'])->name('Guest.index2')->middleware('login');



// Bookings
Route::get('/Booking', [\App\Http\Controllers\BookingController::class, 'index2'])->name('Booking.index2')->middleware('login');
Route::post('/Booking_destroy/{id}', [\App\Http\Controllers\BookingController::class, 'destroy'])->name('Booking.destroy')->middleware('login');
Route::get('/Booking_destroy_ajax/{id}',[\App\Http\Controllers\BookingController::class,'destroy_ajax'])->name('Booking_destroy_ajax')->middleware('login');

Route::post('/Booking_confirm/{booking_id}', [\App\Http\Controllers\BookingController::class, 'confirm'])->name('Booking.confirm')->middleware('login');
Route::get('/Booking_confirm_ajax/{booking_id}', [\App\Http\Controllers\BookingController::class, 'confirm_ajax'])->name('Booking_confirm_ajax')->middleware('login');

Route::post('/Booking_finish/{booking_id}', [\App\Http\Controllers\BookingController::class, 'finish'])->name('Booking.finish')->middleware('login');
Route::get('/Booking_finish_ajax/{id}',[\App\Http\Controllers\BookingController::class,'finish_ajax'])->name('Booking_finish_ajax');

Route::get('/Booking_printer/{id}', [\App\Http\Controllers\BookingController::class, 'printer'])->name('Booking.printer')->middleware('login');

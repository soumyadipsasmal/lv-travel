<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Master\AuthController;
use App\Http\Controllers\Master\DashboardController;
use App\Http\Controllers\Master\TourController;
use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Bookingcontroller;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/tourdetails/{id}', [HomeController::class, 'tourdetails'])->name('tourdetails');
Route::get('/bookings/{id?}', [Bookingcontroller::class, 'bookings'])->name('bookings');
Route::get('/catdetails/{slug}', [HomeController::class, 'catdetails'])->name('catdetails');
Route::post('/booking/store', [Bookingcontroller::class, 'store'])->name('booking.store');


Route::get('/order/details/{id?}', [OrderController::class, 'index'])->name('order.details'); //bookig details
Route::get('/booking/confirm/{id?}', [BookingController::class, 'confirm'])->name('booking.confirm'); //


Route::get('/master/bookings', [BookingController::class, 'viewbookings'])->name('master.viewbookings'); //view Bookings on admin Dashboard
Route::delete('/master/bookings/delete/{id}', [BookingController::class, 'bookings_delete'])->name('bookings.delete'); //Delete Bookings on admin Dashboard
Route::get('/master/bookings/edit/{id}', [BookingController::class, 'bookings_edit'])->name('bookings.edit'); //edit Bookings on admin Dashboard
Route::patch('/master/bookings/update/{id}', [BookingController::class, 'bookings_update'])->name('bookings.update'); //Update Bookings on admin Dashboard


Route::get('/search', [HomeController::class, 'tourSearch'])->name('toursearch');

// Route::get('/index', [HomeController::class, 'index'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// master Route //
// admin guest route //
Route::group(['middleware' => ['guest'], 'prefix' => 'master'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('adminlogin');
    Route::get('/register', [AuthController::class, 'register'])->name('adminregister');
});

// master Auth Route ,,
Route::group(['middleware' => ['auth:web','IsAdmin'], 'prefix' => 'master'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admindashboard');
    Route::get('/profile', [DashboardController::class, 'userProfile'])->name('adminprofile');
    Route::post('/profile/update', [DashboardController::class, 'profileUpdate'])->name('adminprofile.update');
    Route::resource('tours', TourController::class);
    Route::resource('category', CategoryController::class);
});


Route::post('/pay', [PaymentController::class, 'paynow'])->name('pay');


//ajax
Route::post('/customer-Checking', [Bookingcontroller::class, 'customerChecking'])->name('customerChecking');


//after payment
Route::get('/invoice/{id?}', [OrderController::class, 'invoice'])->name('invoice'); // after payment


//user dashboard
Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');

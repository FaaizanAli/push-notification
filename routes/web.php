<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FinanceController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\SchoolController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//clear cache
Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return "Cache is cleared";
});







//admin Login Route
Route::get('/admin-login', [AuthController::class, 'Index'])->name('admin_login');
Route::post('/admin_login', [AuthController::class, 'AdminLogin'])->name('admin_login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


//
Route::get('/', [\App\Http\Controllers\FrontendController::class, 'Index']);



Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [DashboardController::class, 'Dashboard'])->name('admin_dashboard');
    Route::post('/send-notification', [DashboardController::class, 'SendNotification'])->name('send_notification');

});


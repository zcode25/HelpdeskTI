<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboardController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return "Hello";
// });

Route::controller(HomeController::class)->group(function() {
    route::get('/', 'index');
});

Route::controller(DashboardController::class)->group(function() {
    route::get('/admin/dashboard', 'index');
});
Route::resource('/admin/division', DivisionController::class);
Route::controller(EmployeeDashboardController::class)->group(function() {
    route::get('/employee/dashboard', 'index');
});

Route::controller(LoginController::class)->group(function() {
    route::get('/login', 'index');
});

Route::controller(SignupController::class)->group(function() {
    route::get('/signup', 'index');
});

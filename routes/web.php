<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\UserController;
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
Route::controller(EmployeeController::class)->group(function() {
    route::resource('/admin/employee', EmployeeController::class);
});
Route::controller(DivisionController::class)->group(function() {
    route::resource('/admin/division', DivisionController::class);
});
Route::controller(CategoryController::class)->group(function() {
    route::resource('/admin/category', CategoryController::class);
});
Route::controller(SkillController::class)->group(function() {
    route::resource('/admin/skill', SkillController::class);
});
Route::controller(UserController::class)->group(function() {
    route::get('/admin/user', 'index')->name('user.index');
    route::get('/admin/user/create', 'create')->name('user.create');
    route::post('/admin/user/store', 'store')->name('user.store');
    route::get('/admin/user/edit/{user:userId}', 'edit')->name('user.edit');
});
Route::controller(EmployeeDashboardController::class)->group(function() {
    route::get('/employee/dashboard', 'index');
});

Route::controller(LoginController::class)->group(function() {
    route::get('/login', 'index');
});

Route::controller(SignupController::class)->group(function() {
    route::get('/signup', 'index');
});

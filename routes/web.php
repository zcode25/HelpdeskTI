<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\TicketController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Manager\ReportController as ManagerReportController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\Technician\DashboardController as TechnicianDashboardController;
use App\Http\Controllers\Technician\TicketController as TechnicianTicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
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

Route::controller(DashboardController::class)->group(function() {
    route::get('/admin/dashboard', 'index')->middleware(['auth', 'CheckRole:Admin']);
});

Route::controller(DivisionController::class)->group(function() {
    route::resource('/admin/division', DivisionController::class)->middleware(['auth', 'CheckRole:Admin']);
});

Route::controller(CategoryController::class)->group(function() {
    route::resource('/admin/category', CategoryController::class)->middleware(['auth', 'CheckRole:Admin']);
});

Route::controller(UserController::class)->group(function() {
    route::resource('/admin/user', UserController::class)->middleware(['auth', 'CheckRole:Admin']);
    route::put('/admin/user/updateRole/{user:userId}', 'updateRole')->name('user.updateRole')->middleware(['auth', 'CheckRole:Admin']);
    route::put('/admin/user/resetPassword/{user:userId}', 'resetPassword')->name('user.resetPassword')->middleware(['auth', 'CheckRole:Admin']);
    route::post('/admin/user/createSkill', 'createSkill')->name('user.createSkill')->middleware(['auth', 'CheckRole:Admin']);
    route::delete('/admin/user/destorySkill/{techSkill:skillTechId}', 'destroySkill')->name('user.destroySkill')->middleware(['auth', 'CheckRole:Admin']);
});

Route::controller(ClientDashboardController::class)->group(function() {
    route::get('/client/dashboard', 'index')->middleware(['auth', 'CheckRole:Client']);
});

Route::controller(TechnicianDashboardController::class)->group(function() {
    route::get('/technician/dashboard', 'index')->middleware(['auth', 'CheckRole:Technician']);
});

Route::controller(ManagerDashboardController::class)->group(function() {
    route::get('/manager/dashboard', 'index')->middleware(['auth', 'CheckRole:Manager']);
});

Route::controller(TicketController::class)->group(function() {
    Route::get('/client/ticket', 'index')->middleware(['auth', 'CheckRole:Client']);
    Route::get('/client/ticket/create', 'create')->name('client.ticket.create')->middleware(['auth', 'CheckRole:Client']);
    Route::post('/client/ticket/store', 'store')->name('client.ticket.store')->middleware(['auth', 'CheckRole:Client']);
    Route::get('/client/ticket/detail/{ticket:ticketId}', 'detail')->name('client.ticket.detail')->middleware(['auth', 'CheckRole:Client']);
    Route::get('/client/ticket/validationDetail/{ticket:ticketId}', 'validationDetail')->name('client.ticket.validationDetail')->middleware(['auth', 'CheckRole:Client']);
    Route::post('/client/ticket/validation/{ticket:ticketId}', 'validation')->name('client.ticket.validation')->middleware(['auth', 'CheckRole:Client']);
    Route::get('/client/ticket/message/{ticket:ticketId}', 'message')->name('client.ticket.message')->middleware(['auth', 'CheckRole:Client']);
    Route::post('/client/ticket/messageSend/{ticket:ticketId}', 'messageSend')->name('client.ticket.messageSend')->middleware(['auth', 'CheckRole:Client']);
});

Route::controller(AdminTicketController::class)->group(function() {
    Route::get('/admin/ticket', 'index')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/admin/ticket/confirmationDetail/{ticket:ticketId}', 'confirmationDetail')->name('admin.ticket.confirmationDetail')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/admin/ticket/confirmation/{ticket:ticketId}', 'confirmation')->name('admin.ticket.confirmation')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/admin/ticket/assignmentDetail/{ticket:ticketId}', 'assignmentDetail')->name('admin.ticket.assignmentDetail')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/admin/ticket/assignment/{ticket:ticketId}', 'assignment')->name('admin.ticket.assignment')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/admin/ticket/detail/{ticket:ticketId}', 'detail')->name('admin.ticket.detail')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/admin/ticket/complaintConfirmationDetail/{ticket:ticketId}', 'complaintConfirmationDetail')->name('admin.ticket.complaintConfirmationDetail')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/admin/ticket/confirmationComplaint/{ticket:ticketId}', 'confirmationComplaint')->name('admin.ticket.confirmationComplaint')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/admin/ticket/complaintAssignmentDetail/{ticket:ticketId}', 'complaintAssignmentDetail')->name('admin.ticket.complaintAssignmentDetail')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/admin/ticket/assignmentComplaint/{ticket:ticketId}', 'assignmentComplaint')->name('admin.ticket.assignmentComplaint')->middleware(['auth', 'CheckRole:Admin']);
});

route::controller(TechnicianTicketController::class)->group(function() {
    Route::get('/technician/ticket', 'index')->middleware(['auth', 'CheckRole:Technician']);
    Route::get('/technician/ticket/assignmentDetail/{ticket:ticketId}', 'assignmentDetail')->name('technician.ticket.assignmentDetail')->middleware(['auth', 'CheckRole:Technician']);
    Route::post('/technician/ticket/assignment/{ticket:ticketId}', 'assignment')->name('technician.ticket.assignment')->middleware(['auth', 'CheckRole:Technician']);
    Route::get('/technician/ticket/validationDetail/{ticket:ticketId}', 'validationDetail')->name('technician.ticket.validationDetail')->middleware(['auth', 'CheckRole:Technician']);
    Route::post('/technician/ticket/validation/{ticket:ticketId}', 'validation')->name('technician.ticket.validation')->middleware(['auth', 'CheckRole:Technician']);
    Route::get('/technician/ticket/detail/{ticket:ticketId}', 'detail')->name('technician.ticket.detail')->middleware(['auth', 'CheckRole:Technician']);
    Route::get('/technician/ticket/message/{ticket:ticketId}', 'message')->name('technician.ticket.message')->middleware(['auth', 'CheckRole:Technician']);
    Route::post('/technician/ticket/messageSend/{ticket:ticketId}', 'messageSend')->name('technician.ticket.messageSend')->middleware(['auth', 'CheckRole:Technician']);
});

route::controller(ReportController::class)->group(function() {
    Route::get('/admin/report', 'index')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/admin/report/all', 'all')->name('admin.report.all')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/admin/report/target', 'target')->name('admin.report.target')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/admin/report/one/{ticket:ticketId}', 'one')->name('admin.report.one')->middleware(['auth', 'CheckRole:Admin']);
});

route::controller(ManagerReportController::class)->group(function() {
    Route::get('/manager/report', 'index')->middleware(['auth', 'CheckRole:Manager']);
    Route::get('/manager/report/all', 'all')->name('manager.report.all')->middleware(['auth', 'CheckRole:Manager']);
    Route::get('/manager/report/target', 'target')->name('manager.report.target')->middleware(['auth', 'CheckRole:Manager']);
    Route::get('/manager/report/one/{ticket:ticketId}', 'one')->name('manager.report.one')->middleware(['auth', 'CheckRole:Manager']);
});

Route::controller(LoginController::class)->group(function() {
    Route::get('/', 'index')->name('login')->middleware('guest');
    Route::post('/login/authenticate', 'authenticate')->name('login.authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(SignupController::class)->group(function() {
    route::get('/signup', 'index');
});

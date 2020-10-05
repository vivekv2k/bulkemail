<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Email\EmailManagerController;
use App\Http\Controllers\Email\EmailSchedulerController;
use App\Http\Controllers\Email\SendEmailController;
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
    return view('welcome');
});

// email manager
Route::get('/email/manager/view', [EmailManagerController::class, 'index'])->name('email.manager');
Route::get('/email/download/pre-excel', [EmailManagerController::class, 'getPreFormatExcel'])->name('excel.download');
Route::post('/email/import/pre-excel', [EmailManagerController::class, 'impExcelSheet'])->name('excel-import');

// email scheduler
Route::get('/email/scheduler/view', [EmailSchedulerController::class, 'index'])->name('excel-scheduler');
Route::get('/email/scheduler/view-data', [EmailSchedulerController::class, 'getResult'])->name('get-result');
Route::get('/email/scheduler/create', [EmailSchedulerController::class, 'create'])->name('email-scheduler');
Route::post('/email/scheduler/store', [EmailSchedulerController::class, 'store'])->name('email.scheduler');
Route::get('/email/scheduler/send/{id}', [EmailSchedulerController::class, 'sendEmail'])->name('email.send');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');

})->name('dashboard');



<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\SalaryController;
use App\Http\Controllers\backend\MessageController;
use App\Http\Controllers\backend\EmployeeController;
use App\Http\Controllers\backend\DepartmentController;
use App\Http\Controllers\backend\GenerateReportController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   //employees
   Route::prefix('employee')->name('employee.')->group(function (){
      Route::get('/', [EmployeeController::class, 'index'])->name('index');
      Route::get('/create', [EmployeeController::class, 'create'])->name('create');
      Route::post('/store', [EmployeeController::class, 'store'])->name('store');
      Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
      Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('update');
      Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete');
   });
   //messages
   Route::prefix('message')->name('message.')->group(function (){
      Route::get('/', [MessageController::class, 'index'])->name('index');
      Route::post('/store', [MessageController::class, 'store'])->name('store');
      Route::get('/delete/{id}', [MessageController::class, 'delete'])->name('delete');
   });


   
Route::get('/department-employees', [DepartmentController::class, 'showDepartmentEmployees'])->name('show.department.employees');
Route::get('/get-department-employees', [DepartmentController::class, 'getDepartmentEmployees'])->name('get.department.employees');


Route::get('/generate-slip', [SalaryController::class, 'create'])->name('salaries.create');
Route::post('/generate-slip', [SalaryController::class, 'generateSlip'])->name('salaries.generateSlip');
Route::post('/generate-slip/pdf', [SalaryController::class, 'generatePdf'])->name('salaries.generatePdf');

});

require __DIR__.'/auth.php';
require __DIR__.'/api.php';

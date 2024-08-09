<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\employeeController;

Route::get('/', function () {
    return view('welcome');
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
      Route::get('/', [employeeController::class, 'index'])->name('index');
      Route::get('/create', [employeeController::class, 'create'])->name('create');
      Route::post('/store', [employeeController::class, 'store'])->name('store');
      Route::get('/edit/{id}', [employeeController::class, 'edit'])->name('edit');
      Route::post('/update/{id}', [employeeController::class, 'update'])->name('update');
      Route::get('/delete/{id}', [employeeController::class, 'delete'])->name('delete');
   });

});

require __DIR__.'/auth.php';

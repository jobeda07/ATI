<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\backend\DepartmentController;


Route::apiResource('departments', DepartmentController::class);

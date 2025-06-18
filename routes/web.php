<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/admin/employees', [EmployeeController::class, 'index']);
Route::get('/admin/employees/{employee}/edit-role', [EmployeeController::class, 'editRole']);
Route::post('/admin/employees/{employee}/assign-role', [EmployeeController::class, 'assignRole']);

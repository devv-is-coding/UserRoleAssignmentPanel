<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignRoleController;
use App\Http\Middleware\AuthCheck;

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.loginAdmin');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware([AuthCheck::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'adminPanel'])->name('admin.dashboard');

    Route::get('/assign-roles',    [AssignRoleController::class, 'index'])->   name('assign_roles.index');
    Route::get('/assign-roles/create', [AssignRoleController::class, 'create'])->  name('assign_roles.create');
    Route::post('/assign-roles/store',  [AssignRoleController::class, 'store'])->   name('assign_roles.store');
    Route::get('/assign-roles/{id}/edit',[AssignRoleController::class, 'edit'])->    name('assign_roles.edit');
    Route::put('/assign-roles/{id}',    [AssignRoleController::class, 'update'])->  name('assign_roles.update');
    Route::delete('/assign-roles/{id}', [AssignRoleController::class, 'destroy'])-> name('assign_roles.destroy');
});

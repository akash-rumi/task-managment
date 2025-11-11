<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;

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
    return redirect('/dashboard');
})->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

});

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/employees',[EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create',[EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees/store',[EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}/edit',[EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}/update',[EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}/delete',[EmployeeController::class, 'destroy'])->name('employees.destroy');

    Route::get('/tasks',[TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create',[TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/store',[TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit',[TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}/update',[TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}/delete',[TaskController::class, 'destroy'])->name('tasks.destroy');
});

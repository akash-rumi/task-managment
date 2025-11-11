<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProfileController;
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
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/employees',[EmployeeController::class, 'index'])->name('employees');
    Route::get('/employee/{employee}',[EmployeeController::class, 'show'])->name('employee.show');
    
    Route::get('/tasks',[TaskController::class, 'index'])->name('tasks');
    Route::get('/tasks/{task}',[TaskController::class, 'show'])->name('tasks.show');
});

Route::middleware('auth','admin')->group(function() {
    Route::get('/employe/create',[EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee/store',[EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/{employee}/edit',[EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/employee/{employee}/update',[EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee/{employee}/delete',[EmployeeController::class, 'destroy'])->name('employee.destroy');

    Route::get('/task/create',[TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/store',[TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit',[TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}/update',[TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}/delete',[TaskController::class, 'destroy'])->name('tasks.destroy');
});
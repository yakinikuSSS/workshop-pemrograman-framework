<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryController;

Route::get('/', function () {
    return redirect()->route('employees.index');
})->name('home');

Route::resource('employees', EmployeeController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('positions', PositionController::class);
Route::resource('salaries', SalaryController::class);
Route::get('/attendance/{id}/editAttendance', [EmployeeController::class, 'editAttendance'])->name('attendance.editAttendance');
Route::put('/attendance/{id}/updateAttendance', [EmployeeController::class, 'updateAttendance'])->name('attendance.updateAttendance');
Route::delete('/attendance/{id}/deleteAttendance', [EmployeeController::class, 'deleteAttendance'])->name('attendance.deleteAttendance');


Route::get('/positions/by-department/{id}', [EmployeeController::class, 'getPositionsByDepartment'])
    ->name('positions.byDepartment');
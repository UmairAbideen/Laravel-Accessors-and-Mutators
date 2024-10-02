<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;



Route::get('/',[EmployeeController::class,'index'])->name('employee.fetch');
Route::post('/create', [EmployeeController::class,'create'])->name('employee.create');
Route::get('/edit', [EmployeeController::class,'edit'])->name('employee.edit');
Route::delete('/delete', [EmployeeController::class,'delete'])->name('employee.delete');
Route::get('/view', [EmployeeController::class,'view'])->name('employee.view');

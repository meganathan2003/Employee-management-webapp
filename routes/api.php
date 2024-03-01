<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('admin/login', [AdminController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('Employee/create', [EmployeeController::class, 'addEmployee']);
    Route::get('Employee/listall', [EmployeeController::class, 'listAllEmployees']);
    Route::post('Department/create', [DepartmentController::class, 'createDepartment']);
    Route::get('Department/dropdown', [DepartmentController::class, 'departmentDropdown']);
    Route::get('Department/listall', [DepartmentController::class, 'listAllDepartments']);
    Route::post('/Employee/show', [EmployeeController::class, 'show']);
});

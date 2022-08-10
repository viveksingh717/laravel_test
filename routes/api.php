<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeControllers;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('api',App\Http\Controllers\EmployeeControllers::class)->only(['index','store','show','update', 'search', 'destroy']);


// Route::get('/', EmployeeControllers::class, 'index');
// Route::get('/list', EmployeeControllers::class, 'index')->name('list');
// Route::get('/store', EmployeeControllers::class, 'store');
// Route::get('/show', EmployeeControllers::class, 'show');
// Route::get('/search', EmployeeControllers::class, 'search');
// Route::get('/update', EmployeeControllers::class, 'update');
// Route::get('/destroy', EmployeeControllers::class, 'destroy');

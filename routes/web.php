<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CalorificValueController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/home', function () {
    return view('layouts.default');
});

Route::get('/search', [SearchController::class, 'show']);
Route::post('/search', [SearchController::class, 'search']);

Route::get('/calorific-values/{id}/edit',[EditController::class, 'edit']);
Route::put('/calorific-values/{id}',[EditController::class,'update']);

Route::get('/import-areas', [AreaController::class, 'get']);

Route::get('/import-calorificvalues', [CalorificValueController::class, 'get']);



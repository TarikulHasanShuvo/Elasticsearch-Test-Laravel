<?php

use App\Http\Controllers\TestingController;
use App\Models\Article;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::get('/test',[TestingController::class,'search']);

Route::get('/save', [TestingController::class,'save']);

Route::get('/find/{id}', [TestingController::class,'find']);


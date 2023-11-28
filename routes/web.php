<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BracketController;
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




Route::get("bracket_control",[BracketController::class,"bracket_control"])->name("bracket_control");
Route::get('/', function () {
    return view('bracket');
});

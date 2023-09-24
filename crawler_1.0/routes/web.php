<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UrlManipulation;

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

//Route::get('/main', 'MainController@scrape');

//Route::get('/main', [MainController::class, 'scrape']);
//Route::get('/main', [UrlManipulation::class, 'scrape']);
Route::get('newView', [MainController::class, 'newView']);

//[MainController::class, 'scrape']
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/register', 'App\Http\Controllers\HomeController@registerUser')->name('register');
Auth::routes();
Route::get('/', [LoginController::class, 'loginPage']);


Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/admin', 'App\Http\Controllers\HomeController@index')->name('home');
// admin page
Route::get('/dashboard', 'App\Http\Controllers\HomeController@adminDashboardPage')->name('dashboard')->middleware('superAdmin');
Route::get('/management-car', 'App\Http\Controllers\HomeController@managementCarPage')->name('management-car')->middleware('superAdmin');
// consumer page
Route::get('/borrow-car', 'App\Http\Controllers\HomeController@borrowCarPage')->name('borrow-car')->middleware('consumer');
Route::get('/return-car', 'App\Http\Controllers\HomeController@returnCarPage')->name('return-car')->middleware('consumer');

// data
Route::get('/cars', 'App\Http\Controllers\CarsController@getCars')->name('cars');
Route::post('/cars/create', 'App\Http\Controllers\CarsController@createCars')->name('cars-create');
Route::get('/car/available', 'App\Http\Controllers\CarsController@availableCar')->name('car-available');

Route::get('/borrow', 'App\Http\Controllers\BorrowCarController@getBorrowCars')->name('borrow-car-data');
Route::post('/borrow/create', 'App\Http\Controllers\BorrowCarController@borrowCar')->name('borrow-car-insert');

Route::get('/return-back', 'App\Http\Controllers\ReturnCarsController@getReturnCars')->name('return-back');
Route::post('/return/car', 'App\Http\Controllers\ReturnCarsController@returnCar')->name('return-car-data');
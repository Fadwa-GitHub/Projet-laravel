<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//show all listings
Route::get('/', [ListingController::class, 'index']);

//show create
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//store listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

//show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//Update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destory'])->middleware('auth');

//Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//show single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//show regiter/create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');  

//create new user
Route::post('/users', [UserController::class, 'store']);

//Log uesr out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest'); 

//Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']); 



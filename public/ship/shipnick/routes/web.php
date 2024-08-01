<?php

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

Route::get('index', function () {
    return view('index');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/why-us', function () {
    return view('why-us');
});
Route::get('/cookie-policy', function () {
    return view('cookie-policy');
});

Route::get('/privacy', function () {
    return view('privacy');
});
Route::get('/terms-and-conditions', function () {
    return view('terms-and-conditions');
});


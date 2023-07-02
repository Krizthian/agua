<?php

use Illuminate\Support\Facades\Route;

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

//Rutas para el usuario
Route::view('/', 'home')->name('home');
Route::view('/login', 'login')->name('login');

//Rutas para personal del municipio
Route::view('/panel', 'panel')->name('panel');
Route::view('/medidores', 'medidores')->name('medidores');
Route::view('/usuarios', 'usuarios')->name('usuarios');


//Route::view('/about', 'about')->name('about');
//Route::view('/contact', 'contact')->name('contact');
//Route::view('/servicios', 'servicios')->name('servicios');

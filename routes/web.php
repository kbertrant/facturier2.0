<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// route use
Route::get('/profile',  [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('/updateUser',[App\Http\Controllers\UserController::class, 'update'])->name('updateUser');

// route entreprise
Route::get('/entreprise', [App\Http\Controllers\EntrepriseController::class, 'index'])->name('entreprise');
Route::post('/updateEntreprise', [App\Http\Controllers\EntrepriseController::class, 'update'])->name('updateEntreprise');

// route client
Route::get('/listClient',[App\Http\Controllers\ClienteController::class, 'index'])->name('listClient');
Route::post('/addClient',[App\Http\Controllers\ClienteController::class, 'create'])->name('addClient');

// route produit
Route::get('/listProduit',[App\Http\Controllers\ProduitController::class, 'index'])->name('listProduit');
Route::post('/addProduit',[App\Http\Controllers\ProduitController::class, 'create'])->name('addProduit');

// route cat_produit
Route::get('/listCat_produit',[App\Http\Controllers\Cat_produitController::class, 'index'])->name('listCat_produit');
Route::post('/addCat_produit',[App\Http\Controllers\Cat_produitController::class, 'create'])->name('addCat_produit');







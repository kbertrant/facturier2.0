<?php

use App\Http\Controllers\Cat_produitController;
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
Route::get('/cliente', [App\Http\Controllers\ClienteController::class, 'index'])->name('cliente.main');
Route::get('/cliente/list', [App\Http\Controllers\ClienteController::class, 'index'])->name('cliente.list');
Route::post('/cliente/store',[App\Http\Controllers\ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/destroy/{id}',[App\Http\Controllers\ClienteController::class,'destroy'])->name('cliente.destroy');

// route type client
Route::get('/listTypeClient',[App\Http\Controllers\TypeClientController::class, 'index'])->name('listTypeClient');
Route::post('/addTypeClient',[App\Http\Controllers\TypeClientController::class, 'create'])->name('addTypeClient');
Route::get('/type/cliente', [App\Http\Controllers\TypeClientController::class, 'index'])->name('typecliente.main');
Route::get('/type/cliente/list', [App\Http\Controllers\TypeClientController::class, 'index'])->name('typecliente.list');
Route::post('/type/cliente/store',[App\Http\Controllers\TypeClientController::class, 'store'])->name('typecliente.store');
Route::get('/type/cliente/destroy/{id}',[App\Http\Controllers\TypeClientController::class,'destroy'])->name('typecliente.destroy');


// route produit
Route::get('/produit',[App\Http\Controllers\ProduitController::class, 'index'])->name('produit.main');
Route::get('/produit/list',[App\Http\Controllers\ProduitController::class, 'index'])->name('produit.list');
Route::post('/addProduit',[App\Http\Controllers\ProduitController::class, 'create'])->name('addProduit');
Route::post('/produit/store',[App\Http\Controllers\ProduitController::class, 'store'])->name('produit.store');
Route::get('/produit/destroy/{id}',[App\Http\Controllers\ProduitController::class,'destroy'])->name('produit.destroy');

// route cat_produit
Route::post('/cat/produit/store',[Cat_produitController::class, 'store'])->name('catproduit.store');
Route::get('/cat/produit', [Cat_produitController::class, 'index'])->name('catproduit.main');
Route::get('/cat/produit/list', [Cat_produitController::class, 'index'])->name('catproduit.list');
Route::get('/cat/produit/destroy/{id}',[Cat_produitController::class,'destroy'])->name('catproduit.destroy');


// route facture
Route::get('/facture',[App\Http\Controllers\FactureController::class, 'index'])->name('facture.main');
Route::get('/facture/list',[App\Http\Controllers\FactureController::class, 'index'])->name('facture.list');
Route::get('/facture/show/{id}',[App\Http\Controllers\FactureController::class, 'show'])->name('facture.show');
Route::post('/addFacture',[App\Http\Controllers\FactureController::class, 'create'])->name('addFacture');
Route::post('/facture/store',[App\Http\Controllers\FactureController::class, 'store'])->name('facture.store');
Route::get('/facture/destroy/{id}',[App\Http\Controllers\FactureController::class,'destroy'])->name('facture.destroy');
Route::get('/facture/generate/{id}', [App\Http\Controllers\FactureController::class, 'generatePDF'])->name('facture.generate');


// route proforma
Route::get('/proforma',[App\Http\Controllers\ProformasController::class, 'index'])->name('proforma.main');
Route::get('/proforma/list',[App\Http\Controllers\ProformasController::class, 'index'])->name('proforma.list');
Route::post('/addProforma',[App\Http\Controllers\ProformasController::class, 'create'])->name('addProforma');
Route::post('/proforma/store',[App\Http\Controllers\ProformasController::class, 'store'])->name('proforma.store');
Route::get('/proforma/destroy/{id}',[App\Http\Controllers\ProformasController::class,'destroy'])->name('proforma.destroy');
Route::get('/proforma/generate/{id}', [App\Http\Controllers\ProformasController::class, 'generatePDF'])->name('proforma.generate');
Route::get('/proforma/show/{id}',[App\Http\Controllers\ProformasController::class, 'show'])->name('proforma.show');


// route fournisseur
Route::get('/fournisseur',[App\Http\Controllers\FournisseurController::class, 'index'])->name('fournisseur.main');
Route::get('/fournisseur/list',[App\Http\Controllers\FournisseurController::class, 'index'])->name('fournisseur.list');
Route::post('/addProforma',[App\Http\Controllers\FournisseurController::class, 'create'])->name('addFournisseur');
Route::post('/fournisseur/store',[App\Http\Controllers\FournisseurController::class, 'store'])->name('fournisseur.store');
Route::get('/fournisseur/destroy/{id}',[App\Http\Controllers\FournisseurController::class,'destroy'])->name('fournisseur.destroy');






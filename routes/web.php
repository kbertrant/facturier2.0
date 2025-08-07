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
Route::get('lang/my/home', [App\Http\Controllers\LangController::class, 'index']);
Route::get('lang/change', [App\Http\Controllers\LangController::class, 'change'])->name('changeLang');


Auth::routes();

Route::get('/my/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/my/home/list', [App\Http\Controllers\HomeController::class, 'index'])->name('year.list');


// route use
Route::get('/my/profile',  [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('/updateUser',[App\Http\Controllers\UserController::class, 'update'])->name('updateUser');

// route entreprise
Route::get('/my/entreprise', [App\Http\Controllers\EntrepriseController::class, 'index'])->name('entreprise');
Route::post('/my/updateEntreprise', [App\Http\Controllers\EntrepriseController::class, 'update'])->name('updateEntreprise');

// route client
Route::get('/my/client/list',[App\Http\Controllers\ClienteController::class, 'index'])->name('listClient');
Route::post('/add/lient',[App\Http\Controllers\ClienteController::class, 'create'])->name('addClient');
Route::get('/my/cliente', [App\Http\Controllers\ClienteController::class, 'index'])->name('cliente.main');
Route::get('/cliente/list', [App\Http\Controllers\ClienteController::class, 'index'])->name('cliente.list');
Route::post('/cliente/store',[App\Http\Controllers\ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/destroy/{id}',[App\Http\Controllers\ClienteController::class,'destroy'])->name('cliente.destroy');
Route::get('/cliente/show/{id}',[App\Http\Controllers\ClienteController::class, 'show'])->name('cliente.show');
Route::get('/cliente/edit/{id}', [App\Http\Controllers\ClienteController::class, 'edit'])->name('cliente.edit');
Route::post('/cliente/update',[App\Http\Controllers\ClienteController::class, 'update'])->name('cliente.update');


// route type client
Route::get('/my/type/client/list',[App\Http\Controllers\TypeClientController::class, 'index'])->name('listTypeClient');
Route::post('/addTypeClient',[App\Http\Controllers\TypeClientController::class, 'create'])->name('addTypeClient');
Route::get('/my/type/cliente', [App\Http\Controllers\TypeClientController::class, 'index'])->name('typecliente.main');
Route::get('/type/cliente/list', [App\Http\Controllers\TypeClientController::class, 'index'])->name('typecliente.list');
Route::post('/type/cliente/store',[App\Http\Controllers\TypeClientController::class, 'store'])->name('typecliente.store');
Route::get('/type/cliente/destroy/{id}',[App\Http\Controllers\TypeClientController::class,'destroy'])->name('typecliente.destroy');


// route produit
Route::get('/my/produit',[App\Http\Controllers\ProduitController::class, 'index'])->name('produit.main');
Route::get('/produit/list',[App\Http\Controllers\ProduitController::class, 'index'])->name('produit.list');
Route::get('/produit/show/{id}',[App\Http\Controllers\ProduitController::class, 'show'])->name('produit.show');

Route::get('/produit/ajax/{id}',[App\Http\Controllers\ProduitController::class, 'ajaxShow'])->name('produit.ajax');
Route::post('/addProduit',[App\Http\Controllers\ProduitController::class, 'create'])->name('addProduit');
Route::post('/produit/store',[App\Http\Controllers\ProduitController::class, 'store'])->name('produit.store');
Route::get('/produit/edit/{id}', [App\Http\Controllers\ProduitController::class, 'edit'])->name('produit.edit');
Route::post('/produit/update',[App\Http\Controllers\ProduitController::class, 'update'])->name('produit.update');
Route::get('/produit/destroy/{id}',[App\Http\Controllers\ProduitController::class,'destroy'])->name('produit.destroy');

// route cat_produit
Route::post('/cat/produit/store',[Cat_produitController::class, 'store'])->name('catproduit.store');
Route::get('/my/cat/produit', [Cat_produitController::class, 'index'])->name('catproduit.main');
Route::get('/cat/produit/list', [Cat_produitController::class, 'index'])->name('catproduit.list');
Route::get('/cat/produit/destroy/{id}',[Cat_produitController::class,'destroy'])->name('catproduit.destroy');
Route::get('/cat/produit/edit/{id}', [App\Http\Controllers\Cat_produitController::class, 'edit'])->name('catproduit.edit');
Route::post('/cat/produit/update',[App\Http\Controllers\Cat_produitController::class, 'update'])->name('catproduit.update');



// route facture
Route::get('client/autocomplete', [App\Http\Controllers\FactureController::class,'autocomplete'])->name('autocomplete');
Route::get('/my/facture',[App\Http\Controllers\FactureController::class, 'index'])->name('facture.main');
Route::get('/facture/list',[App\Http\Controllers\FactureController::class, 'index'])->name('facture.list');
Route::get('/facture/show/{id}',[App\Http\Controllers\FactureController::class, 'show'])->name('facture.show');
Route::post('/addFacture',[App\Http\Controllers\FactureController::class, 'create'])->name('addFacture');
Route::post('/facture/store',[App\Http\Controllers\FactureController::class, 'store'])->name('facture.store');
Route::get('/facture/destroy/{id}',[App\Http\Controllers\FactureController::class,'destroy'])->name('facture.destroy');
Route::get('/facture/generate/{id}', [App\Http\Controllers\FactureController::class, 'generatePDF'])->name('facture.generate');
Route::get('/cliente/factures/list/{id}', [App\Http\Controllers\FactureController::class, 'facturesClient'])->name('clfacture.list');


// route proforma
Route::get('/my/proforma',[App\Http\Controllers\ProformasController::class, 'index'])->name('proforma.main');
Route::get('/proforma/list',[App\Http\Controllers\ProformasController::class, 'index'])->name('proforma.list');
Route::post('/addProforma',[App\Http\Controllers\ProformasController::class, 'create'])->name('addProforma');
Route::post('/proforma/store',[App\Http\Controllers\ProformasController::class, 'store'])->name('proforma.store');
Route::get('/proforma/destroy/{id}',[App\Http\Controllers\ProformasController::class,'destroy'])->name('proforma.destroy');
Route::get('/proforma/generate/{id}', [App\Http\Controllers\ProformasController::class, 'generatePDF'])->name('proforma.generate');
Route::get('/proforma/show/{id}',[App\Http\Controllers\ProformasController::class, 'show'])->name('proforma.show');
Route::get('/proforma/validate/{id}', [App\Http\Controllers\ProformasController::class, 'validPro'])->name('proforma.validate');
Route::get('/proforma/edit/{id}', [App\Http\Controllers\ProformasController::class, 'edit'])->name('proforma.edit');
Route::post('/proforma/update',[App\Http\Controllers\ProformasController::class, 'update'])->name('proforma.update');


// route fournisseur
Route::get('/my/fournisseur',[App\Http\Controllers\FournisseurController::class, 'index'])->name('fournisseur.main');
Route::get('/fournisseur/list',[App\Http\Controllers\FournisseurController::class, 'index'])->name('fournisseur.list');
Route::post('/addProforma',[App\Http\Controllers\FournisseurController::class, 'create'])->name('addFournisseur');
Route::post('/fournisseur/store',[App\Http\Controllers\FournisseurController::class, 'store'])->name('fournisseur.store');
Route::get('/fournisseur/destroy/{id}',[App\Http\Controllers\FournisseurController::class,'destroy'])->name('fournisseur.destroy');


// route paiement
Route::get('/my/payment',[App\Http\Controllers\PaiementController::class, 'index'])->name('payment.main');
Route::get('/payment/list',[App\Http\Controllers\PaiementController::class, 'index'])->name('payment.list');
Route::post('/addaPayment',[App\Http\Controllers\PaiementController::class, 'create'])->name('addPayment');
Route::post('/payment/store',[App\Http\Controllers\PaiementController::class, 'store'])->name('payment.store');
Route::get('/payment/show/{id}',[App\Http\Controllers\PaiementController::class, 'show'])->name('payment.show');
Route::get('/payment/generate/{id}', [App\Http\Controllers\PaiementController::class, 'generatePDF'])->name('payment.generate');
// route user
Route::get('/my/user',[App\Http\Controllers\UserController::class, 'index'])->name('user.main');
Route::get('/user/my/list',[App\Http\Controllers\UserController::class, 'index'])->name('user.list');
Route::get('/user/admin/list',[App\Http\Controllers\UserController::class, 'listAdmin'])->name('user.admin');
Route::post('/user/add',[App\Http\Controllers\UserController::class, 'create'])->name('addUser');
Route::post('/user/store',[App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::get('/user/destroy/{id}',[App\Http\Controllers\UserController::class,'destroy'])->name('user.destroy');
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update',[App\Http\Controllers\UserController::class, 'update'])->name('user.update');

//depenses
Route::get('/my/depense',[App\Http\Controllers\DepenseController::class, 'index'])->name('depense.main');
Route::get('/depense/list',[App\Http\Controllers\DepenseController::class, 'index'])->name('depense.list');
Route::post('/depense/add',[App\Http\Controllers\DepenseController::class, 'create'])->name('addDepense');
Route::post('/depense/store',[App\Http\Controllers\DepenseController::class, 'store'])->name('depense.store');
Route::get('/depense/destroy/{id}',[App\Http\Controllers\DepenseController::class,'destroy'])->name('depense.destroy');
Route::get('/depense/show/{id}',[App\Http\Controllers\DepenseController::class, 'show'])->name('depense.show');
Route::get('/depense/generate/{id}', [App\Http\Controllers\DepenseController::class, 'generatePDF'])->name('depense.generate');

//tresorerie
Route::get('/my/tresor',[App\Http\Controllers\TresorerieController::class, 'index'])->name('tresor.main');
Route::get('/tresor/list',[App\Http\Controllers\TresorerieController::class, 'index'])->name('tresor.list');
Route::post('/tresor/store',[App\Http\Controllers\TresorerieController::class, 'store'])->name('tresor.store');
Route::get('/tresor/generate/{id}', [App\Http\Controllers\TresorerieController::class, 'generatePDF'])->name('tresor.generate');

Route::get('/my/pres/quotation',[App\Http\Controllers\PrestationController::class, 'formQuotation'])->name('pres.formQuotation');
Route::get('/my/pres/invoice',[App\Http\Controllers\PrestationController::class, 'formInvoice'])->name('pres.formInvoice');
Route::post('/my/save/quotation',[App\Http\Controllers\PrestationController::class, 'saveQuotation'])->name('pres.saveQuotation');
Route::post('/my/save/invoice',[App\Http\Controllers\PrestationController::class, 'saveInvoice'])->name('pres.saveInvoice');

//Role
Route::get('/my/role/list',[App\Http\Controllers\RoleController::class, 'index'])->name('listRole');
//Route::post('/add/role',[App\Http\Controllers\RoleController::class, 'create'])->name('addRole');
Route::get('/my/role', [App\Http\Controllers\RoleController::class, 'index'])->name('role.main');
Route::get('/role/list', [App\Http\Controllers\RoleController::class, 'index'])->name('role.list');
//Route::post('/role/store',[App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
//Route::get('/role/destroy/{id}',[App\Http\Controllers\RoleController::class,'destroy'])->name('role.destroy');
//Route::get('/role/show/{id}',[App\Http\Controllers\RoleController::class, 'show'])->name('role.show');
//Route::get('/role/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
//Route::post('/role/update',[App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
//
////Permission
Route::get('/my/perm/list',[App\Http\Controllers\PermissionController::class, 'index'])->name('listPerm');
//Route::post('/add/perm',[App\Http\Controllers\PermissionController::class, 'create'])->name('addPerm');
Route::get('/my/perm', [App\Http\Controllers\PermissionController::class, 'index'])->name('perm.main');
Route::get('/perm/list', [App\Http\Controllers\PermissionController::class, 'index'])->name('perm.list');
//Route::post('/perm/store',[App\Http\Controllers\PermissionController::class, 'store'])->name('perm.store');
//Route::get('/perm/destroy/{id}',[App\Http\Controllers\PermissionController::class,'destroy'])->name('perm.destroy');
//Route::get('/perm/show/{id}',[App\Http\Controllers\PermissionController::class, 'show'])->name('perm.show');
//Route::get('/perm/edit/{id}', [App\Http\Controllers\PermissionController::class, 'edit'])->name('perm.edit');
//Route::post('/perm/update',[App\Http\Controllers\PermissionController::class, 'update'])->name('perm.update');

// route shops
Route::get('/my/shop',[App\Http\Controllers\ShopController::class, 'index'])->name('shop.main');
Route::get('/shop/my/list',[App\Http\Controllers\ShopController::class, 'index'])->name('shop.list');
Route::post('/shop/add',[App\Http\Controllers\ShopController::class, 'create'])->name('addShop');
Route::post('/shop/store',[App\Http\Controllers\ShopController::class, 'store'])->name('shop.store');
Route::get('/shop/destroy/{id}',[App\Http\Controllers\ShopController::class,'destroy'])->name('shop.destroy');
Route::get('/shop/edit/{id}', [App\Http\Controllers\ShopController::class, 'edit'])->name('shop.edit');
Route::post('/shop/update',[App\Http\Controllers\ShopController::class, 'update'])->name('shop.update');

Route::resource('roles', App\Http\Controllers\RoleController::class);
Route::resource('permissions', App\Http\Controllers\PermissionController::class);





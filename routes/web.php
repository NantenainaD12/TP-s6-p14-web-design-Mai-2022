<?php

use App\Http\Controllers\Con_Bon_Commande;
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


Route::get('/', function () {
    return view('Bon_cmd');
});*/
Route::get('/insert_Bon_cmd',[Con_Bon_Commande::class,'insert'])->name('Bon_cmd.index');
Route::get('/By_id',[Con_Bon_Commande::class,'get_bc_byId']);
Route::get('/',[Con_Bon_Commande::class,'all_demande_achat']);
Route::get('/insert_bc',[Con_Bon_Commande::class,'insert_bc']);
Route::get('/show_Bon_cmd_a_valider',[Con_Bon_Commande::class,'get_non_receptionner']);
Route::get('/insert_reception',[Con_Bon_Commande::class,'insert_reception']);
Route::get('/show_Bon_cmd',[Con_Bon_Commande::class,'show_Bon_cmd']);
Route::get('/all_fournisseur',[Con_Bon_Commande::class,'all_fournisseur']);
Route::get('/all_proforma',[Con_Bon_Commande::class,'get_proforma_by_idCmd']);
Route::get('/Bon_cmd', function () {
    return view('Bon_cmd');
});
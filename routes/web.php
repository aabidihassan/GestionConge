<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\UserController;
use app\Http\Controllers\AdminController;
use Illuminate\Auth\SessionGuard;
use App\Http\Controllers\NbJoursController;
use App\Http\Controllers\demandeController;
use App\Http\Controllers\demandesController;

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
    if(!Auth::check()){
        return view('auth.login');
    }else{
        return demandesController::indexUser();
    }
});

Route::get('/dashboard', function () {
    if(Auth::user()->type=="chef"){
        return demandesController::indexChef();
    }
    if(Auth::user()->type=="user"){
        return demandesController::indexUser();
    }
})->middleware(['auth'])->name('dashboard');



Route::get('/demande', function () {
    return view('user.demande');
})->middleware(['auth'])->name('demande');



Route::get('/demandes', function () {
    return demandesController::remplacement();
})->middleware(['auth'])->name('demandes');

Route::post('/newDemande',[demandesController::class,'insertDemande'])->middleware(['auth'])->name('newDemande');

Route::post('/adjointAccepte',[demandesController::class,'adjointAction'])->middleware(['auth'])->name('adjointAccepte');

Route::post('/adjointDecline',[demandesController::class,'adjointAction'])->middleware(['auth'])->name('adjointDecline');



require __DIR__.'/auth.php';

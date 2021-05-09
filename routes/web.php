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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    if(Auth::user()->type=="admin"){
        return NbJoursController::showUser();
    }
    if(Auth::user()->type=="user"){
        return NbJoursController::showUser();
    }
})->middleware(['auth'])->name('dashboard');



Route::get('/demande', function () {
    return view('user.demande');
})->middleware(['auth'])->name('demande');



Route::get('/demandes', function () {
    return demandesController::indexUser();
})->middleware(['auth'])->name('demandes');

Route::post('/newDemande',[demandesController::class,'insertDemande'])->middleware(['auth'])->name('newDemande');



require __DIR__.'/auth.php';

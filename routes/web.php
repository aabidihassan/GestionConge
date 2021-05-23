<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\UserController;
use app\Http\Controllers\AdminController;
use Illuminate\Auth\SessionGuard;
use App\Http\Controllers\NbJoursController;
use App\Http\Controllers\demandeController;
use App\Http\Controllers\demandesController;
use App\Http\Controllers\ServiceController;

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
        if(auth()->user()->type=="admin") ServiceController::accuile();
        return demandesController::indexUser();
    }
});

Route::get('/dashboard', function () {
    if(auth()->user()->type=="admin") return ServiceController::accuile();
    return demandesController::indexUser();
})->middleware(['auth'])->name('dashboard');

Route::get('/service', function () {
    return ServiceController::serviceDemandes();
})->middleware(['auth'])->name('service');

Route::get('/employees', function () {
    return ServiceController::getServices();
})->middleware(['auth'])->name('employees');


Route::get('/demande', function () {
    return demandesController::listUsers();
})->middleware(['auth'])->name('demande');



Route::get('/demandes', function () {
    if(auth()->user()->type=="admin")
    return ServiceController::getDemandes();
    return demandesController::remplacement();
})->middleware(['auth'])->name('demandes');


// Route::get('/getEmployeeService', function () {
//     return demandesController::listUsers();
// })->middleware(['auth'])->name('getEmployeeService');


Route::post('/newDemande',[demandesController::class,'insertDemande'])->middleware(['auth'])->name('newDemande');

Route::post('/adjointAccepte',[demandesController::class,'adjointAction'])->middleware(['auth'])->name('adjointAccepte');

Route::post('/adjointDecline',[demandesController::class,'adjointAction'])->middleware(['auth'])->name('adjointDecline');

Route::post('/serviceAccepte',[ServiceController::class,'servicetAction'])->middleware(['auth'])->name('serviceAccepte');

Route::post('/serviceDecline',[ServiceController::class,'serviceAction'])->middleware(['auth'])->name('serviceDecline');

Route::post('/getEmployees',[ServiceController::class,'getEmployees'])->middleware(['auth'])->name('getEmployees');

Route::post('/employees',[ServiceController::class,'employees'])->middleware(['auth'])->name('employees');

Route::post('/chefAction',[ServiceController::class,'chefAction'])->middleware(['auth'])->name('chefAction');

Route::post('/changeService',[ServiceController::class,'changeService'])->middleware(['auth'])->name('changeService');

//Route::post('/getEmployeeService',[demandesController::class,'listUsers'])->middleware(['auth'])->name('getEmployeeService');



require __DIR__.'/auth.php';

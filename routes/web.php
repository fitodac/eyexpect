<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\PatientController;


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
  return Inertia::render('Home', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register')
  ]);
});


Route::get('nosotros', function () {
	return Inertia::render('SobreEyexpect');
})->name('nosotros');


Route::get('nota-legal', function () {
	return Inertia::render('NotaLegal');
})->name('nota-legal');



Route::middleware(['auth:sanctum', 'verified'])->group(function(){
	Route::get('dashboard', [PatientController::class, 'index'])->name('dashboard');
	Route::resource('pacientes', PatientController::class);
});

// Route::get('/storage-link', function(){
// 	\Illuminate\Support\Facades\Artisan::call('storage:link'); 
// 	return 'Se ha regenerado el storage link'; 
// });

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//  return Inertia::render('Dashboard');
//})->name('dashboard');

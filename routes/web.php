<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('auth.login');
});

// Admin ALl Route
Route::controller(AdminController::class)->group(function () {
    Route::get('admin/logout', 'destroy')->name('admin.logout');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(ParticipanteController::class)->group(function () {
    Route::get('/participantes', 'index')->name('participantes.index');
    Route::get('/participante/{id}', 'show')->name('participante.show');
    Route::get('/participante/{id}/edit', 'edit')->name('participante.edit');
    Route::post('/participante/{id}/edit', 'update')->name('participante.update');
    Route::get('/participantes/create', 'create')->name('participantes.create');
    Route::post('/participantes/store', 'store')->name('participantes.store');
})->middleware(['auth']);

Route::controller(VendedorController::class)->group(function () {
    Route::get('/vendedores', 'index')->name('vendedores.index');
    Route::get('/vendedor/{id}', 'show')->name('vendedor.show');
    Route::get('/vendedor/{id}/edit', 'edit')->name('vendedor.edit');
    Route::post('/vendedor/{id}/edit', 'update')->name('vendedor.update');
    Route::get('/vendedores/create', 'create')->name('vendedores.create');
    Route::post('/vendedores/store', 'store')->name('vendedores.store');
})->middleware(['auth']);


require __DIR__.'/auth.php';

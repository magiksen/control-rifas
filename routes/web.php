<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\NumeroController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SendMessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\RoleController;
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
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'profileupdate'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::controller(ParticipanteController::class)->group(function () {
        Route::get('/participantes', 'index')->name('participantes.index')->middleware('can:participantes.list');
        Route::get('/participante/{id}', 'show')->name('participante.show')->middleware('can:participantes.list');
        Route::get('/participante/{id}/edit', 'edit')->name('participante.edit')->middleware('can:participantes.edit');
        Route::post('/participante/{id}/edit', 'update')->name('participante.update')->middleware('can:participantes.edit');
        Route::get('/participantes/create', 'create')->name('participantes.create')->middleware('can:participantes.add');
        Route::post('/participantes/store', 'store')->name('participantes.store')->middleware('can:participantes.add');
        Route::get('/participante/{id}/delete', 'destroy')->name('participante.destroy')->middleware('can:participantes.delete');
        Route::get('/participante/{id}/pagar', 'pagoparticipante')->name('participante.pagar')->middleware('can:participantes.pagar');
    });

    Route::controller(VendedorController::class)->group(function () {
        Route::get('/vendedores', 'index')->name('vendedores.index')->middleware('can:vendedores.list');
        Route::get('/vendedor/{id}', 'show')->name('vendedor.show')->middleware('can:vendedores.list');
        Route::get('/vendedor/{id}/edit', 'edit')->name('vendedor.edit')->middleware('can:vendedores.edit');
        Route::post('/vendedor/{id}/edit', 'update')->name('vendedor.update')->middleware('can:vendedores.edit');
        Route::get('/vendedores/create', 'create')->name('vendedores.create')->middleware('can:vendedores.add');
        Route::post('/vendedores/store', 'store')->name('vendedores.store')->middleware('can:vendedores.add');
        Route::get('/vendedor/{id}/delete', 'destroy')->name('vendedor.destroy')->middleware('can:vendedores.delete');
    });

    Route::controller(NumeroController::class)->group(function () {
        Route::get('/numeros', 'index')->name('numeros.index');
        Route::get('/numero/{id}', 'show')->name('numero.show');
    });

    Route::controller(TicketController::class)->group(function () {
        Route::get('/tickets', 'index')->name('tickets.index')->middleware('can:tickets.list');
        Route::get('/ticket/{id}', 'show')->name('ticket.show')->middleware('can:tickets.list');
        Route::get('/tickets/create/{numero?}', 'create')->name('tickets.create')->middleware('can:tickets.add');
        Route::get('/tickets/multiplecreate', 'multiplecreate')->name('tickets.multiplecreate')->middleware('can:tickets.add');
        Route::post('/tickets/store', 'store')->name('tickets.store')->middleware('can:tickets.add');
        Route::post('/tickets/multiplestore', 'multiplestore')->name('tickets.multiplestore')->middleware('can:tickets.add');
        Route::get('/ticket/{id}/pagar', 'pago')->name('ticket.pagar')->middleware('can:tickets.pagar');
        Route::get('/ticket/{id}/delete', 'destroy')->name('ticket.destroy')->middleware('can:tickets.delete');
        Route::get('/tickets/imagenes', 'reimagines')->name('ticket.imagenes')->middleware('can:tickets.add');
        Route::get('/tickets/control', 'cuadrocontrol')->name('tickets.control')->middleware('can:tickets.add');
    });

    Route::controller(SendMessageController::class)->group(function () {
        Route::get('/enviarws/{id}', 'sendmessage')->name('message.send')->middleware('can:mensajes.enviar');
        Route::get('/enviarmultiple/{id}', 'sendmultiple')->name('message.multiple')->middleware('can:mensajes.enviar');
    });

    Route::controller(ReporteController::class)->group(function () {
        Route::get('/reporte/tickets', 'reportetickets')->name('reporte.tickets')->middleware('can:reportes.list');
        Route::get('/reporte/participantes', 'reporteparticipantes')->name('reporte.participantes')->middleware('can:reportes.list');
        Route::get('/reporte/vendedores', 'reportevendedores')->name('reporte.vendedores')->middleware('can:reportes.list');
    });

    Route::controller(OptionController::class)->group(function () {
        Route::get('/opciones', 'index')->name('opciones.index')->middleware('can:opciones.list');
        Route::get('/opcion/{id}/edit', 'edit')->name('opcion.edit')->middleware('can:opciones.edit');
        Route::post('/opcion/{id}/edit', 'update')->name('opcion.update')->middleware('can:opciones.edit');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/permisos', 'permisos')->name('permisos')->middleware('can:roles.list');
        Route::get('/permisos/crear', 'crearpermiso')->name('crear.permiso')->middleware('can:roles.add');
        Route::post('/permisos/store', 'storepermiso')->name('store.permiso')->middleware('can:roles.add');
        Route::get('/permiso/{id}/edit', 'editpermiso')->name('editar.permiso')->middleware('can:roles.edit');
        Route::post('/permiso/{id}/edit', 'updatepermiso')->name('update.permiso')->middleware('can:roles.edit');

        //ROLES

        Route::get('/roles', 'roles')->name('roles')->middleware('can:roles.list');
        Route::get('/roles/crear', 'addrole')->name('crear.rol')->middleware('can:roles.add');
        Route::post('/roles/store', 'storerole')->name('store.rol')->middleware('can:roles.add');
        Route::get('/role/{id}/edit', 'editrole')->name('editar.rol')->middleware('can:roles.edit');
        Route::post('/role/{id}/edit', 'updaterole')->name('update.rol')->middleware('can:roles.edit');

        //Roles en permisos

        Route::get('/add/roles/permisos', 'addrolespermisos')->name('add.roles.permiso')->middleware('can:roles.add');
        Route::post('/roles/permisos/store', 'storerolespermisos')->name('store.role.permission')->middleware('can:roles.add');
        Route::get('/edit/roles/permisos/{id}', 'editarrolespermisos')->name('editar.roles.permisos')->middleware('can:roles.edit');
        Route::post('/roles/permisos/update/{id}', 'updaterolespermisos')->name('update.role.permission')->middleware('can:roles.edit');
    });

});

require __DIR__.'/auth.php';

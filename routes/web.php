<?php

use Illuminate\Support\Facades\Route;

// Livewire Pages
use App\Livewire\Dashboard\Home as DashboardHome;

use App\Livewire\Pedidos\Index as PedidosIndex;
use App\Livewire\Pedidos\Crear as PedidosCrear;
use App\Livewire\Pedidos\Ver   as PedidosVer;

use App\Livewire\Locales\Index as LocalesIndex;
use App\Livewire\Locales\Crear as LocalesCrear;
use App\Livewire\Locales\Editar as LocalesEditar;

use App\Livewire\Productos\Index as ProductosIndex;
use App\Livewire\Productos\Crear as ProductosCrear;
use App\Livewire\Productos\Editar as ProductosEditar;

use App\Livewire\Proveedores\Index as ProveedoresIndex;
use App\Livewire\Proveedores\Crear as ProveedoresCrear;
use App\Livewire\Proveedores\Editar as ProveedoresEditar;

use App\Livewire\Marcas\Index as MarcasIndex;
use App\Livewire\Marcas\Crear as MarcasCrear;
use App\Livewire\Marcas\Editar as MarcasEditar;

// Controllers
use App\Http\Controllers\PedidoPrintController;

/*
|--------------------------------------------------------------------------
| Home (redirige según sesión)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
})->name('home');

/*
|--------------------------------------------------------------------------
| Rutas protegidas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', DashboardHome::class)->name('dashboard');

    // Pedidos
    Route::get('/pedidos',                PedidosIndex::class)->name('pedidos.index');
    Route::get('/pedidos/crear',          PedidosCrear::class)->name('pedidos.crear');
    Route::get('/pedidos/{pedido}',       PedidosVer::class)->name('pedidos.ver');
    Route::get('/pedidos/{pedido}/imprimir', [PedidoPrintController::class, 'show'])
        ->name('pedidos.imprimir');
        

    // Locales
    Route::get('/locales',                LocalesIndex::class)->name('locales.index');
    Route::get('/locales/crear',          LocalesCrear::class)->name('locales.crear');
    Route::get('/locales/{local}/editar', LocalesEditar::class)->name('locales.editar');

    // Productos
Route::get('/productos',                      ProductosIndex::class)->name('productos.index');
Route::get('/productos/crear',                ProductosCrear::class)->name('productos.crear');
Route::get('/productos/{producto}/editar',    ProductosEditar::class)->name('productos.editar');


// Proveedores
Route::get('/proveedores',                       ProveedoresIndex::class)->name('proveedores.index');
Route::get('/proveedores/crear',                 ProveedoresCrear::class)->name('proveedores.crear');
Route::get('/proveedores/{id}/editar',           ProveedoresEditar::class)->name('proveedores.editar');
////


    // Marcas
    Route::get('/marcas',                 MarcasIndex::class)->name('marcas.index');
    Route::get('/marcas/crear',           MarcasCrear::class)->name('marcas.crear');
    Route::get('/marcas/{marca}/editar',  MarcasEditar::class)->name('marcas.editar');
});

/*
|--------------------------------------------------------------------------
| Auth scaffolding (si existe)
|--------------------------------------------------------------------------
*/
if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}

<?php

use App\Http\Controllers\addUsuarioController;
use App\Http\Controllers\UserSettingsController;
use GuzzleHttp\Promise\Create;
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
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/nueva-contraseña', [UserSettingsController::class, 'nuevaContraseña'])->name('nuevaContraseña')->middleware(['auth']);
Route::post('/cambiar/contraseña', [UserSettingsController::class, 'cambiarContraseña'])->name('cambiarContraseña')->middleware(['auth']);
Route::get('/palindromas/buscar/', [UserSettingsController::class, 'palindromas'])->name('palindromas')->middleware(['auth']);
// Route::post('/palindromas/{palabra}/buscar', [UserSettingsController::class, 'palindromasBuscar'])->name('palindromasBuscar')->middleware(['auth']);

Route::get('/agenda', [addUsuarioController::class, 'index'])->name('index.usuario')->middleware(['auth']);
Route::get('/create/usuario', [addUsuarioController::class, 'create'])->name('create.usuario')->middleware(['auth']);
Route::post('/create/usuario', [addUsuarioController::class, 'store'])->name('store.usuario')->middleware(['auth']);
Route::get('/editar/usuario/{id}/edit', [addUsuarioController::class, 'edit'])->name('edit.usuario')->middleware(['auth']);
Route::put('/actualizar/usuario/{id}', [addUsuarioController::class, 'update'])->name('update.usuario')->middleware(['auth']);
Route::delete('/usuario/eliminar/{id}', [addUsuarioController::class, 'destroy'])->name('destroy.usuario')->middleware('auth');
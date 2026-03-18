<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('items/cart', [ItemController::class, 'cart'])->name('cart.index')->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//rotas Da Página Dos ADMIN's:
Route::get('pagina/admin',[ItemController::class,'pedidos'])->name('pagina.admin');
Route::post('pagina/admin/FinalizarPedido/{id}',[ItemController::class,'FinalizarPedido'])->name('FinalizarPedido')->middleware('auth');
//Rotas Cardápio:
Route::get('items/manha', [ItemController::class, 'cardapioManha'])->name('cardapioManha')->middleware('auth');
Route::get('items/almoço', [ItemController::class, 'cardapioAlmoço'])->name('cardapioAlmoço')->middleware('auth');
Route::get('items/tarde', [ItemController::class, 'cardapioTarde'])->name('cardapioTarde')->middleware('auth');
Route::get('items/noite', [ItemController::class, 'cardapioNoite'])->name('cardapioNoite')->middleware('auth');
//Rotas Dos Pedidos
Route::get('items/PedidoSucesso', [ItemController::class, 'PedidoSucesso'])->name('PedidoSucesso.index')->middleware('auth');
Route::post('items/cart/confirmarPedido', [ItemController::class, 'confirmarPedido'])->name('confirmarPedido')->middleware('auth');
Route::middleware(['auth'])->group(function (){
    Route::resource('items',ItemController::class);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// AJAX
Route::get('admin/verificar-pedidos',[ItemController::class,'verificarPedidos']);
Route::get('admin/pedidos-json',[ItemController::class,'pedidosJson']);


require __DIR__.'/auth.php';

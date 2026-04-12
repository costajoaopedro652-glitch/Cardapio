<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Models\Item;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//carrinho
Route::get('items/cart', [ItemController::class, 'cart'])->name('cart.index')->middleware('auth');

//rotas Da Página Dos ADMIN's:
Route::middleware(['auth'])->group(function(){
    Route::get('/download/pdf',[ItemController::class,'gerarPDF'])->name('downloadPedidos');
    Route::get('/admin',[ItemController::class,'admin'])->name('admin');
    Route::get('/admin/historicoPedidos',[ItemController::class, 'historicoPedidos'])->name('admin.historicoPedidos');//feito
    Route::get('/admin/historicoPedidos/pdf',[ItemController::class, 'historicoPedidosPdf'])->name('admin.historicoPedidos.pdf');//feito
    Route::get('admin/cadastrarHospedes',[ItemController::class, 'adminCadastrar'])->name('admin.cadastrar');//feito
    Route::post('admin/cadastrarHospedes',[ItemController::class, 'cadastrarHospede'])->name('admin.cadastrarhospede');//feito
    Route::get('/admin/hospedes',[ItemController::class,'hospedes'])->name('admin.hospedes');//feito
    Route::get('admin/historicoHospedes',[ItemController::class,'hospedesHistorico'])->name('admin.historicoHospedes');//feito
    Route::patch('admin/desospedar/{hospede}',[ItemController::class, 'desospedar'])->name('admin.desospedar');
    Route::get('/admin/pedidos',[ItemController::class,'pedidos'])->name('admin.pedidos');//feito
    Route::post('admin/FinalizarPedido/{id}',[ItemController::class,'FinalizarPedido'])->name('FinalizarPedido');//feito
    Route::get('admin/users',[ItemController::class,'usuarios'])->name('admin.users');//feito
    Route::post('admin/users/role',[ItemController::class,'updateRole'])->name('admin.users.role');//feito
});

//cardápios: 
Route::middleware(['auth'])->group(function (){
    Route::get('items/manha', [ItemController::class, 'cardapioManha'])->name('cardapioManha');
    Route::get('items/almoço', [ItemController::class, 'cardapioAlmoço'])->name('cardapioAlmoço');
    Route::get('items/tarde', [ItemController::class, 'cardapioTarde'])->name('cardapioTarde');
    Route::get('items/noite', [ItemController::class, 'cardapioNoite'])->name('cardapioNoite');
});

//Rotas Dos Pedidos
Route::middleware(['auth'])->group(function (){
    Route::get('items/PedidoSucesso', [ItemController::class, 'PedidoSucesso'])->name('PedidoSucesso.index');
    Route::post('items/cart/confirmarPedido', [ItemController::class, 'confirmarPedido'])->name('confirmarPedido');
});

//Criar novos items
Route::middleware(['auth'])->group(function (){
Route::get('items/pedidos/criar',[ItemController::class, 'criarItem'])->name('items.criar');
Route::post('items/pedidos/salvar',[ItemController::class, 'salvar'])->name('items.criar.salvar');
Route::get('items/{item}/editar',[ItemController::class, 'editar'])->name('items.editar');
Route::patch('items/{item}/atualizar',[ItemController::class, 'atualizar'])->name('items.atualizar');
Route::delete('items/{item}/delete',[ItemController::class,'deletar'])->name('items.deletar');
});

Route::middleware(['auth'])->group(function (){
    Route::resource('items',ItemController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// AJAX
Route::get('admin/verificar-pedidos',[ItemController::class,'verificarPedidos']);
Route::get('admin/pedidos-json',[ItemController::class,'pedidosJson']);


require __DIR__.'/auth.php';


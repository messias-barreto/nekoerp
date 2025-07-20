<?php

use App\Http\Controllers\Carrinho\AddQuantidadeProdutoNoCarrinhoController;
use App\Http\Controllers\Carrinho\AplicarCupomDescontoController;
use App\Http\Controllers\Carrinho\IndexController;
use App\Http\Controllers\Carrinho\RemoveQuantidadeProdutoNoCarrinhoController;
use App\Http\Controllers\Carrinho\StoreProdutoNoCarrinho;
use App\Http\Controllers\Produto\IndexProdutoController;
use App\Http\Controllers\Produto\StoreProdutoController;
use App\Http\Controllers\Produto\UpdateProdutoController;
use App\Http\Controllers\Carrinho\RemoverCupomDescontoController;
use App\Http\Controllers\Pedido\IndexPedidoController;
use App\Http\Controllers\Pedido\StorePedidoController;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexProdutoController::class, 'handle']);
Route::get('/produtos-create', [IndexProdutoController::class, 'handle']);
Route::post('/produtos-store', [StoreProdutoController::class, 'handle'])->name('produtos.store');
Route::post('/produtos-update', [UpdateProdutoController::class, 'handle'])->name('produtos.update');
Route::post('/carrinho', [StoreProdutoNoCarrinho::class, 'handle'])->name('carrinho.store');
Route::get('/carrinho', [IndexController::class, 'handle'])->name('carrinho.index');
Route::post('/carrinho/produto/add-quantidade', [AddQuantidadeProdutoNoCarrinhoController::class, 'handle'])->name('carrinho.add-quantidade-produto');
Route::post('/carrinho/produto/remove-quantidade', [RemoveQuantidadeProdutoNoCarrinhoController::class, 'handle'])->name('carrinho.remove-quantidade-produto');
Route::post('/carrinho/cupom', [AplicarCupomDescontoController::class, 'handle'])->name('carrinho.aplicar-cupom');
Route::post('/carrinho/cupom/delete', [RemoverCupomDescontoController::class, 'handle'])->name('carrinho.remover-cupom');
Route::post('/pedido', [StorePedidoController::class, 'handle'])->name('pedido.store');
Route::get('/pedido', [IndexPedidoController::class, 'handle'])->name('pedidos.index');

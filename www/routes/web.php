<?php

use App\Http\Controllers\Carrinho\StoreProdutoNoCarrinho;
use App\Http\Controllers\Produto\IndexProdutoController;
use App\Http\Controllers\Produto\StoreProdutoController;
use App\Http\Controllers\Produto\UpdateProdutoController;
use Illuminate\Support\Facades\Route;


Route::get('/produtos-create', [IndexProdutoController::class, 'handle']);
Route::get('/', [IndexProdutoController::class, 'handle']);
Route::post('/produtos-store', [StoreProdutoController::class, 'handle'])->name('produtos.store');
Route::post('/produtos-update', [UpdateProdutoController::class, 'handle'])->name('produtos.update');
Route::post('/carrinho', [StoreProdutoNoCarrinho::class, 'handle'])->name('carrinho.store');

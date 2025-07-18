<?php

use App\Http\Controllers\Produto\CreateNewProdutoController;
use App\Http\Controllers\Produto\IndexProdutoController;
use App\Http\Controllers\Produto\StoreProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produtos-create', [IndexProdutoController::class, 'handle']);
Route::post('/produtos-store', [StoreProdutoController::class, 'handle'])->name('produtos.store');
<?php

use App\Http\Controllers\Webhook\AlterarStatusPedidoController;
use Illuminate\Support\Facades\Route;

Route::post('/webhook/pedidos', [AlterarStatusPedidoController::class, 'handle']);

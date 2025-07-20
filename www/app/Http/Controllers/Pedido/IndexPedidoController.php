<?php

namespace App\Http\Controllers\Pedido;

use App\UseCase\Pedido\ObterPedidosUseCase;

class IndexPedidoController
{
    public function __construct(
        private readonly ObterPedidosUseCase $useCase
    ) {}
    public function handle()
    {
        $response = $this->useCase->execute();
        return view('pedidos.index', compact('response'));
    }
}

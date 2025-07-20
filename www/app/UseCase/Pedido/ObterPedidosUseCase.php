<?php

namespace App\UseCase\Pedido;

use App\Interfaces\PedidoInterface;

class ObterPedidosUseCase
{
    public function __construct(
        private readonly PedidoInterface $pedidoRepository
    ) {}

    public function execute(): array
    {
        $pedidos = $this->pedidoRepository->getAllPedidos();
        return [
            'success' => true,
            'data' => $pedidos
        ];
    }
}

<?php
namespace App\UseCase\Pedido;

use App\Interfaces\PedidoInterface;
use Illuminate\Support\Facades\Session;

class AddNewPedidoUseCase
{
    public function __construct(
        private readonly PedidoInterface $pedidoRepository,
        private readonly Session $session
    ) {}

    public function execute(array $data): array
    {
        $pedido = $this->pedidoRepository->create($data);
        if(!$pedido->exists()) {
            return [
                'success' => false,
                'message' => 'Falha na Tentativa de Adicionar o Pedido'
            ];
        }

        $this->session::flush('carrinho-produtos');
        return [
            'success' => true,
            'message' => 'Pedido foi Adicionado'
        ];
    }
}

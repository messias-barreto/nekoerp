<?php

namespace App\UseCase\Pedido;

use App\Interfaces\PedidoInterface;

class AlterarStatusPedidoUseCase
{
    const STATUS = ['pendente', 'concluido', 'cancelado'];

    public function __construct(
        private readonly PedidoInterface $pedidoRepository
    ) {}

    public function execute(array $data): array
    {
        if(array_search($data['status'], self::STATUS) == false) {
            return [
                'success' => false,
                'message' => 'Status Solicitado não foi Encontrado'
            ];
        }

        $pedido = $this->pedidoRepository->findById($data['id']);

        if(empty($pedido)) {
            return [
                'success' => false,
                'message' => 'Pedido Solicitado Não foi Encontrado!'
            ];
        }

        if($pedido->status == 'cancelado') {
            return [
                'success' => true,
                'message' => 'Pedido Solicitado Já Consta como Cancelado!'
            ];
        }

        if($data['status'])

        $pedidoAtualizado = $this->pedidoRepository->updateStatus($data['id'], $data['status']);
        if(empty($pedidoAtualizado)) {
            return [
                'success' => false,
                'message' => 'Não foi possível atualizar o Status do Pedido'
            ];
        }

        return [
            'success' => true,
            'message' => 'Status do Pedido Solicitado foi Atualizado!'
        ];
    }
}

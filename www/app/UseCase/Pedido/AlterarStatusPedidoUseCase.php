<?php

namespace App\UseCase\Pedido;

use App\Interfaces\PedidoInterface;
use App\Mail\NotificacaoPedido;
use Illuminate\Support\Facades\Mail;

class AlterarStatusPedidoUseCase
{
    const STATUS = ['pendente', 'aprovado', 'cancelado'];

    public function __construct(
        private readonly PedidoInterface $pedidoRepository,
        private readonly Mail $mail
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

        $pedidoAtualizado = $this->pedidoRepository->updateStatus($data['id'], $data['status']);
        if(empty($pedidoAtualizado)) {
            return [
                'success' => false,
                'message' => 'Não foi possível atualizar o Status do Pedido'
            ];
        }

        $pedido->status = $data['status'];
        $this->enviarEmail($pedido->toArray());
        return [
            'success' => true,
            'message' => 'Status do Pedido Solicitado foi Atualizado!'
        ];
    }

    public function enviarEmail(array $pedido)
    {
        $this->mail::to($pedido['client_email'])->send(new NotificacaoPedido([
            'data' => $pedido
        ]));
    }
}

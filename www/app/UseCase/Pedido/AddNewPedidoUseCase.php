<?php

namespace App\UseCase\Pedido;

use App\Interfaces\PedidoInterface;
use App\Mail\NotificacaoPedido;
use App\Models\Pedido;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AddNewPedidoUseCase
{
    public function __construct(
        private readonly PedidoInterface $pedidoRepository,
        private readonly Session $session,
        private readonly Mail $mail,
    ) {}

    public function execute(array $data): array
    {
        $pedido = $this->pedidoRepository->create($data);
        if (!$pedido->exists()) {
            return [
                'success' => false,
                'message' => 'Falha na Tentativa de Adicionar o Pedido'
            ];
        }

        $this->session::flush('carrinho-produtos');
        $this->enviarEmail($pedido->toArray());

        return [
            'success' => true,
            'message' => 'Pedido foi Adicionado'
        ];
    }

    public function enviarEmail(array $pedido)
    {
        $pedido['status'] = 'pendente';
        $this->mail::to($pedido['client_email'])->send(new NotificacaoPedido([
            'data' => $pedido
        ]));
    }
}

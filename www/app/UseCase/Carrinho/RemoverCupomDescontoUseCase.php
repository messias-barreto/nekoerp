<?php

namespace App\UseCase\Carrinho;

use Illuminate\Support\Facades\Session;

class RemoverCupomDescontoUseCase
{
    public function __construct(
        private readonly Session $session
    ) {}

    public function execute(): array
    {
        $carrinho = $this->session::get('carrinho-produtos');
        if(isset($carrinho['cupom'])) {
            unset($carrinho['cupom']);
        }

        $this->session::put('carrinho-produtos', $carrinho);

        return [
            'success' => true,
            'message' => 'Cupom Removido com Sucesso'
        ];
    }
}

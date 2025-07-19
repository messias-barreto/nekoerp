<?php

namespace App\UseCase\Carrinho;

use Illuminate\Support\Facades\Session;

class ObterDadosDoCarrinhoUseCase
{
    public function __construct(
        private readonly Session $session
    ) {}

    public function execute(): array
    {
        $carrinho = $this->session::get('carrinho-produtos');
        $valorTotal =$this->obterTotalPedido($carrinho['produtos']);
        if(empty($carrinho['total']) || $carrinho['total'] != $valorTotal) {
            $carrinho['total'] = $valorTotal;
        }

        return [
            'success' => true,
            'data' => $carrinho
        ];
    }


    public function obterTotalPedido(array $produtos)
    {
        $valorTotal = 0;
        foreach($produtos as $produto) {
            $valorTotal = $valorTotal + ($produto['price'] * $produto['qtd']);
        }

        return $valorTotal;
    }
}

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
        $produtos = $this->removerProdutosQuantidadeZero($carrinho['produtos']);

        $valorTotal =$this->obterTotalPedido($produtos);
        if(empty($carrinho['total']) || $carrinho['total'] != $valorTotal) {
            $carrinho['total'] = $valorTotal;
        }

        $carrinho['produtos'] = $produtos;
        $this->session::put('carrinho-produtos', $carrinho);
        return [
            'success' => true,
            'data' => $carrinho
        ];
    }

    public function removerProdutosQuantidadeZero(array $produtos): array
    {
        $produtosFiltrados = array_filter($produtos, function ($item) {
            return $item['qtd'] > 0;
        });

        return array_values($produtosFiltrados);
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

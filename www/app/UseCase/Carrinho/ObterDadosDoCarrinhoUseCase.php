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
        if(empty($carrinho['produtos'])) {
            $this->session::flush('carrinho-produtos');
            return [
                'data' => [
                    'produtos' => [],
                    'subtotal' => 0,
                    'frete' => 0,
                    'total' => 0
                ],
            ];
        }
        $produtos = $this->removerProdutosQuantidadeZero($carrinho['produtos']);

        $valorTotal =$this->obterTotalPedido($produtos);
        $carrinho['frete'] = $this->calcularFrete($valorTotal);

        if(empty($carrinho['subtotal']) || $carrinho['subtotal'] != $valorTotal) {
            $carrinho['subtotal'] = $valorTotal;
        }

        $descontoCupom = 0;
        if(isset($carrinho['cupom'])) {
            $descontoCupom = $this->calcularValorCupom($carrinho['cupom']['desconto'], $valorTotal);
            $carrinho['subtotalComDesconto'] = ($valorTotal - $descontoCupom) + $carrinho['frete'];
        }

        $carrinho['total'] = $valorTotal + $carrinho['frete'];
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

    public function calcularFrete(float $subtotal): float
    {
        if($subtotal >= 52 && $subtotal < 166.60) {
            return 15;
        }

        if($subtotal > 200) {
            return 0;
        }

        return 20;
    }

    public function calcularValorCupom(int $desconto, float $subtotal): float
    {
        $totalDesconto = $subtotal * ($desconto /  100);
        return (float) round($totalDesconto, 2);
    }
}

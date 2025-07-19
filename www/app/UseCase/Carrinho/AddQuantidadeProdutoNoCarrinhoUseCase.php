<?php

namespace App\UseCase\Carrinho;

use App\Interfaces\EstoqueInterface;
use App\Interfaces\ProdutoInterface;
use Illuminate\Support\Facades\Session;

class AddQuantidadeProdutoNoCarrinhoUseCase
{
    public function __construct(
        private readonly ProdutoInterface $produtoRepository,
        private readonly EstoqueInterface $estoqueRepository,
        private readonly Session $session
    ) {}

    public function execute(array $data): array
    {
        $carrinho = $this->session::get('carrinho-produtos');
        $newCarrinho = $carrinho['produtos'];

        foreach($newCarrinho as &$produto) {
            if($produto['id'] == $data['produto_id']) {
                $produto['qtd'] += 1;

                $estoque = $this->estoqueRepository->findByProduto($produto['id']);
                if($produto['qtd'] > $estoque->quantidade) {
                    return [
                        'success' => false,
                        'message' => 'Nao Possuimos essa quantidade em Estoque!'
                    ];
                }

                $estoqueQuantidade = $estoque->quantidade - 1;
                $this->estoqueRepository->updateEstoque($estoque->id, $estoqueQuantidade);

                break;
            }
        }

        $this->session::put('carrinho-produtos', ['produtos' => $newCarrinho]);
        return [
            'success' => true
        ];
    }
}

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

                $estoque = $this->estoqueRepository->findByProduto($produto['id']);
                if($produto['qtd'] > $estoque->quantidade) {
                    return [
                        'success' => false,
                        'message' => 'Nao Possuimos essa quantidade em Estoque!'
                    ];
                }

                $produto['qtd'] += 1;
                $estoqueQuantidade = $estoque->quantidade - 1;
                $this->estoqueRepository->updateEstoque($estoque->id, $estoqueQuantidade);

                break;
            }
        }

        $carrinho['produtos'] = $newCarrinho;

        $this->session::put('carrinho-produtos', $carrinho);
        return [
            'success' => true
        ];
    }
}

<?php

namespace App\UseCase\Carrinho;

use App\Interfaces\EstoqueInterface;
use App\Interfaces\ProdutoInterface;

use Illuminate\Support\Facades\Session;

class RemoveQuantidadeProdutoNoCarrinhoUseCase
{
    public function __construct(
        private readonly ProdutoInterface $produtoRepository,
        private readonly EstoqueInterface $estoqueRepository,
        private Session $session
    ) {}

    public function execute(array $data): array
    {
        $carrinho = $this->session::get('carrinho-produtos');
        $newCarrinho = $carrinho['produtos'];

        foreach ($newCarrinho as $key => &$produto) {
            if ($produto['id'] == $data['produto_id']) {
                $produto['qtd'] -= 1;

                $estoque = $this->estoqueRepository->findByProduto($produto['id']);
                $estoqueQuantidade = $estoque->quantidade + 1;
                $this->estoqueRepository->updateEstoque($estoque->id, $estoqueQuantidade);

                if ($produto['qtd'] == 0) {
                    unset($newCarrinho[$key]);
                }

                break;
            }
        }

        unset($produto);

        $carrinho['produtos'] = array_values($newCarrinho);
        $this->session::put('carrinho-produtos', $carrinho);

        return [
            'success' => true
        ];
    }
}

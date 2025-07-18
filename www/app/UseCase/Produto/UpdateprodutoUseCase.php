<?php

namespace App\UseCase\Produto;

use App\Interfaces\EstoqueInterface;
use App\Interfaces\ProdutoInterface;

class UpdateprodutoUseCase
{
    public function __construct(
        private readonly ProdutoInterface $produtoRepository,
        private readonly EstoqueInterface $estoqueRepository
    ) {}

    public function execute(array $data): array
    {
        $produto = $this->produtoRepository->updateProduto($data);
        if(!$produto) {
            return [
                'success' => false,
                'message' => 'Não foi Possível Atualizar o Produto'
            ];
        }

        $estoque = $this->estoqueRepository->findByProduto($data['id']);
        $updateEstoque = $this->estoqueRepository->updateEstoque($estoque->id, $data['stock']);
        if(!$updateEstoque) {
            return [
                'success' => false,
                'message' => 'Falha na Tentativa de Atualizar o Estoque'
            ];
        }

        return [
            'success' => true,
            'message' => 'Produto Atualizado com Sucesso!'
        ];
    }
}

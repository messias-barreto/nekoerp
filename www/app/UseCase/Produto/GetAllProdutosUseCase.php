<?php

namespace App\UseCase\Produto;

use App\Interfaces\ProdutoInterface;

class GetAllProdutosUseCase
{
    public function __construct(
        private readonly ProdutoInterface $produtoRepository
    ) {}

    public function execute(): array 
    {
        $produtos = $this->produtoRepository->getAllProdutos();
        return [
            'success' => true,
            'products' => $produtos
        ];
    }
}

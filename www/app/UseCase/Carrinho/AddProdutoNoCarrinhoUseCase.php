<?php

namespace App\UseCase\Carrinho;

use App\Interfaces\EstoqueInterface;
use App\Interfaces\ProdutoInterface;
use App\Models\Produto;
use Illuminate\Support\Facades\Session;

class AddProdutoNoCarrinhoUseCase
{
    public function __construct(
        private readonly ProdutoInterface $produtoRepository,
        private readonly EstoqueInterface $estoqueRepository,
        private Session $session
    ) {}
    public function execute(array $data): array
    {
        $produto = $this->produtoRepository->findById($data['produto-id']);
        if (!$produto) {
            return [
                'success' => false,
                'message' => 'Produto Solicitado Não foi Encontrado'
            ];
        }

        $estoque = $this->estoqueRepository->findByProduto($produto->id);
        if (!$estoque->exists || $estoque->quantidade < 1) {
            return [
                'success' => false,
                'message' => 'Não há unidades disponíveis em estoque.'
            ];
        }

        $produtoSession = $this->session::get('carrinho-produtos');
        if (isset($produtoSession) && $this->verificarProdutoEmSessao($produtoSession['produtos'], $produto->id)) {
            return [
                'success' => false,
                'message' => 'Produto Já consta no Carrinho'
            ];
        }

        $carrinhoProduto = [];
        if(isset($produtoSession['produtos'])) {
            $carrinhoProduto = $produtoSession['produtos'];
        }

        array_push($carrinhoProduto, [
            'id' => $produto->id,
            'name' => $produto->name,
            'qtd' => 1
        ]);

        $this->addProdutoEmSessao($carrinhoProduto);
        $this->estoqueRepository->removeQtdInEstoque($estoque->id);

        return [
            'success' => true,
            'message' => 'Produto Foi Adicionado ao Carrinho'
        ];
    }


    public function addProdutoEmSessao(array $produtos)
    {
        $this->session::put('carrinho-produtos', ['produtos' => $produtos]);
    }

    public function verificarProdutoEmSessao(array $produtos, int $produtoId): bool
    {
        $ids = array_column($produtos, 'id');
        if (in_array($produtoId, $ids)) {
            return true;
        }

        return false;
    }
}

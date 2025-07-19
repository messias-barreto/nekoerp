<?php

namespace App\UseCase\Produto;

use App\Interfaces\EstoqueInterface;
use App\Interfaces\ProdutoInterface;
use App\Interfaces\VariacaoProdutoInterface;
use Illuminate\Support\Facades\DB;

class CreateNewProdutoUseCase
{
    public function __construct(
        private readonly ProdutoInterface $produtoRepository,
        private readonly VariacaoProdutoInterface $variacaoProdutoRepository,
        private readonly EstoqueInterface $estoqueRepository
    ) {}

    public function execute(array $data): array
    {
        DB::beginTransaction();
        $produto = $this->produtoRepository->create($data);
        if (!$produto->exists() || !$produto->id) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Erro ao criar produto'
            ];
        }

        $estoque = $this->estoqueRepository->create([
            'produto_id' => $produto->id,
            'quantidade' => $data['stock']
        ]);

        if (!$estoque->exists() || !$estoque->id) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Erro ao criar estoque'
            ];
        }

        if (isset($data['variations'])) {
            $this->makeVariant($produto->id, $data['variations']);
        }

        DB::commit();
        return [
            'success' => true,
            'message' => 'Produto criado com sucesso',
        ];
    }

    public function makeVariant(int $produto_id, array $data): void
    {
        foreach ($data as $variation) {
            $variation['produto_id'] = $produto_id;
            $this->variacaoProdutoRepository->create($variation);
        }
    }
}

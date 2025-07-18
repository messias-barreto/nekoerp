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
        if(!$produto->exists() || !$produto->id) {
            DB::rollBack();
            return [
                'success' => false, 
                'message' => 'Erro ao criar produto'
            ];
        }

        if(empty($data['variations'])) {
            dd('sasass');
        }

        foreach ($data['variations'] as $variation) {
            $variation['produto_id'] = $produto->id;
            $variacaoProduto = $this->variacaoProdutoRepository->create($variation);
            $estoque = $this->estoqueRepository->create([
                'variacao_produto_id' => $variacaoProduto->id,
                'quantidade' => $variation['stock']
            ]);
            
            dd($estoque);
        }

        if($produto->exists()) {
            dd('existe');
        }

        dd('nao existe');

        return [
            'success' => true,
            'message' => 'Produto criado com sucesso',
        ];
    }
}

<?php

namespace App\Repository;

use App\Interfaces\ProdutoInterface;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProdutoRepository implements ProdutoInterface
{
    private Model $repository;
    public function __construct()
    {
        $this->repository = app(Produto::class);
    }

    public function create(array $data): Produto
    {
        return $this->repository->create($data);
    }

    public function findById(int $id): Produto
    {
        return $this->repository->find($id);
    }

    public function getAllProdutos(): LengthAwarePaginator
    {
        return $this->repository->select('produtos.id', 'produtos.name', 'produtos.price', 'produtos.type', 'estoques.quantidade AS stock')
        ->join('estoques', 'estoques.produto_id', 'produtos.id')
        ->paginate(9);
    }

    public function updateProduto(array $data): bool
    {
        $produto = $this->repository->find($data['id']);
        return $produto->update($data);
    }
}

<?php
namespace App\Repository;

use App\Interfaces\EstoqueInterface;
use App\Models\Estoque;
use Illuminate\Database\Eloquent\Model;

class EstoqueRepository implements EstoqueInterface
{
    private Model $repository;
    public function __construct()
    {
        $this->repository = app(Estoque::class);
    }

    public function create(array $data): Estoque
    {
        return $this->repository->create($data);
    }

    public function findByProduto(int $produto_id): Estoque
    {
        return $this->repository->where('produto_id', $produto_id)->first();
    }

    public function addQtdInEstoque($estoque_id): bool
    {
        $estoque = $this->repository->find($estoque_id);
        return $estoque->update(['quantidade' => $estoque->quantidade + 1]);
    }

    public function removeQtdInEstoque(int $id): bool
    {
        $estoque = $this->repository->find($id);
        return $estoque->update(['quantidade' => $estoque->quantidade - 1]);
    }

    public function updateEstoque(int $id, int $qtd): bool
    {
        $estoque = $this->repository->find($id);
        return $estoque->update(['quantidade' => $qtd]);
    }
}

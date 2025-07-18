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

    public function addQtdInEstoque($estoque_id): Estoque
    {   
        $estoque = $this->repository->find($estoque_id);
        return $estoque->update(['qtd_estoque' => $estoque->qtd_estoque + 1]);   
    }

    public function removeQtdInEstoque(int $qtd): Estoque
    {
        $estoque = $this->repository->find($qtd);
        return $estoque->update(['qtd_estoque' => $estoque->qtd_estoque - 1]);
    }
}
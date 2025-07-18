<?php

namespace App\Repository;

use App\Interfaces\VariacaoProdutoInterface;
use App\Models\VariacaoProduto;
use Illuminate\Database\Eloquent\Model;

class VariacaoProdutoRepository implements VariacaoProdutoInterface
{
    private Model $repository;
    public function __construct()
    {
        $this->repository = app(VariacaoProduto::class);
    }

    public function create(array $data): VariacaoProduto
    {
        return $this->repository->create($data);
    }
}

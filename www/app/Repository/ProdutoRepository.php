<?php 

namespace App\Repository;

use App\Interfaces\ProdutoInterface;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Model;

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
}
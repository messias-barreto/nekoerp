<?php
namespace App\Repository;

use App\Interfaces\CupomInterface;
use App\Models\Cupom;
use Illuminate\Database\Eloquent\Model;

class CupomRepository implements CupomInterface
{
    private Model $repository;
    public function __construct()
    {
        $this->repository = app(Cupom::class);
    }

    public function findByName(string $name): ?Cupom
    {
        return $this->repository->where('name', $name)->first();
    }

    public function alterarQuantidade(int $id, int $quantidade): bool
    {
        return $this->repository->find($id)->update(['quantidade' => $quantidade]);

    }
}

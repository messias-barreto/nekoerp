<?php
namespace App\Repository;

use App\Interfaces\PedidoInterface;
use App\Models\Pedido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PedidoRepository implements PedidoInterface
{
    private Model $repository;
    public function __construct()
    {
        $this->repository = app(Pedido::class);
    }

    public function create(array $data): Pedido
    {
        return $this->repository->create($data);
    }

    public function getAllPedidos(): LengthAwarePaginator
    {
        return $this->repository->paginate(10);
    }

    public function findById(int $id): ?Pedido
    {
        return $this->repository->find($id);
    }

    public function updateStatus(int $id, string $status): bool
    {
        return $this->repository->find($id)->update([
            'status' => $status
        ]);
    }
}

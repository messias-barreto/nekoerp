<?php
namespace App\Interfaces;

use App\Models\Pedido;
use Illuminate\Pagination\LengthAwarePaginator;

interface PedidoInterface
{
    public function create(array $data): Pedido;
    public function getAllPedidos(): LengthAwarePaginator;
}

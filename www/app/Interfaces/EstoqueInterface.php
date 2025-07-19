<?php
namespace App\Interfaces;

use App\Models\Estoque;

interface EstoqueInterface
{
    public function create(array $data): Estoque;
    public function findByProduto(int $produto_id): Estoque;
    public function updateEstoque(int $id, int $qtd): bool;
    public function addQtdInEstoque(int $id): bool;
    public function removeQtdInEstoque(int $id): bool;
}

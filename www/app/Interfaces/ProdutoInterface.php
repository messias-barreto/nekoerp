<?php
namespace App\Interfaces;
use App\Models\Produto;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProdutoInterface
{
    public function create(array $data): Produto;
    public function getAllProdutos(): LengthAwarePaginator;
    public function updateProduto(array $data): bool;
}

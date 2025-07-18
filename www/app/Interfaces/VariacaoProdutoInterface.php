<?php 
namespace App\Interfaces;

use App\Models\VariacaoProduto;

interface VariacaoProdutoInterface
{
    public function create(array $data): VariacaoProduto;
}
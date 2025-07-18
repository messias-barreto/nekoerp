<?php 
namespace App\Interfaces;
use App\Models\Produto;

interface ProdutoInterface 
{
    public function create(array $data): Produto;
}
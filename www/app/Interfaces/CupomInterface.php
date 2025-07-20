<?php

namespace App\Interfaces;

use App\Models\Cupom;

interface CupomInterface
{
    public function findByName(string $name): ?Cupom;
    public function alterarQuantidade(int $id, int $quantidade): bool;
}

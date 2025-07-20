<?php

namespace App\Interfaces;

use App\Models\Cupom;

interface CupomInterface
{
    public function findByName(string $name): ?Cupom;
}

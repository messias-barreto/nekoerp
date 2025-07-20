<?php

namespace App\Http\Controllers\Carrinho;

use App\UseCase\Carrinho\RemoverCupomDescontoUseCase;

class RemoverCupomDescontoController
{
    public function __construct(
        private readonly RemoverCupomDescontoUseCase $useCase
    ) {}
    public function handle()
    {
        $this->useCase->execute();
        return redirect()->back();
    }
}

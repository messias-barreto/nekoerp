<?php

namespace App\Http\Controllers\Carrinho;

use App\UseCase\Carrinho\AplicarCupomDescontoUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AplicarCupomDescontoController
{
    public function __construct(
        private readonly AplicarCupomDescontoUseCase $useCase
    ) {}
    public function handle(Request $request): RedirectResponse
    {
        $response = $this->useCase->execute($request->all());
        return redirect()->back();
    }
}

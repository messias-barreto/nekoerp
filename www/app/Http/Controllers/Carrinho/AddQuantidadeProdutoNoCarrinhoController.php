<?php

namespace App\Http\Controllers\Carrinho;

use App\UseCase\Carrinho\AddQuantidadeProdutoNoCarrinhoUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AddQuantidadeProdutoNoCarrinhoController
{
    public function __construct(
        private readonly AddQuantidadeProdutoNoCarrinhoUseCase $useCase
    ) {}

    public function handle(Request $request): RedirectResponse
    {
        $response = $this->useCase->execute($request->all());
        return redirect()->back();
    }
}

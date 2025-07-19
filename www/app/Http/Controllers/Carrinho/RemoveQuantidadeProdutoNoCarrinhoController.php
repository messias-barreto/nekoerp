<?php

namespace App\Http\Controllers\Carrinho;
use App\UseCase\Carrinho\RemoveQuantidadeProdutoNoCarrinhoUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RemoveQuantidadeProdutoNoCarrinhoController
{
    public function __construct(
        private readonly RemoveQuantidadeProdutoNoCarrinhoUseCase $useCase
    ) {}

    public function handle(Request $request): RedirectResponse
    {
        $response = $this->useCase->execute($request->all());
        return redirect('/carrinho');
    }
}

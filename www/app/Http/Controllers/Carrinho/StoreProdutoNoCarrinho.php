<?php

namespace App\Http\Controllers\Carrinho;

use App\UseCase\Carrinho\AddProdutoNoCarrinhoUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StoreProdutoNoCarrinho
{

    public function __construct(
        private readonly AddProdutoNoCarrinhoUseCase $useCase
    ) {}
    public function handle(Request $request): RedirectResponse
    {
        $response = $this->useCase->execute($request->all());
        return redirect()->back()->with('response-data', $response);;
    }
}

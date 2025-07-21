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
        if($response['success'] == false) {
            return redirect()->back()->with('response-data', $response);
        }

        return redirect()->back();
    }
}

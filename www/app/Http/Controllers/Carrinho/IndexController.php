<?php

namespace App\Http\Controllers\Carrinho;

use App\UseCase\Carrinho\ObterDadosDoCarrinhoUseCase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController
{
    public function __construct(
        private readonly ObterDadosDoCarrinhoUseCase $useCase
    ) {}
    public function handle(Request $request): View
    {
        $response = $this->useCase->execute();
        return view('carrinho.index', compact('response'));
    }
}

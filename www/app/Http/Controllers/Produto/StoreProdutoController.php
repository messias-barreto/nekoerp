<?php

namespace App\Http\Controllers\Produto;

use App\UseCase\Produto\CreateNewProdutoUseCase;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreProdutoController
{
    public function __construct(
        private readonly CreateNewProdutoUseCase $useCase
    ) {}

    public function handle(Request $request): View
    {
        $response = $this->useCase->execute($request->all());
        return view('produto.store');
    }
}

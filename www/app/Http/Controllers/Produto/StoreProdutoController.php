<?php

namespace App\Http\Controllers\Produto;

use App\UseCase\Produto\CreateNewProdutoUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StoreProdutoController
{
    public function __construct(
        private readonly CreateNewProdutoUseCase $useCase
    ) {}

    public function handle(Request $request): RedirectResponse
    {
        $response = $this->useCase->execute($request->all());
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Produto;

use App\Http\Controllers\Controller;
use App\UseCase\Produto\GetAllProdutosUseCase;
use Illuminate\View\View;

class IndexProdutoController extends Controller
{
    public function __construct(
        private readonly GetAllProdutosUseCase $useCase
    ) {}

    public function handle(): View
    {
        $response = $this->useCase->execute();
        return view('produto.index', compact('response'));
    }
}

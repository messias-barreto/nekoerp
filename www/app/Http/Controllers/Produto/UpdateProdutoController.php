<?php
namespace App\Http\Controllers\Produto;

use App\UseCase\Produto\UpdateprodutoUseCase;
use Illuminate\Http\Request;

class UpdateProdutoController
{
    public function __construct(
        private readonly UpdateprodutoUseCase $useCase
    )
    {

    }
    public function handle(Request $request)
    {
        $response = $this->useCase->execute($request->all());
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Pedido;

use App\UseCase\Pedido\AddNewPedidoUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StorePedidoController
{
    public function __construct(
        private readonly AddNewPedidoUseCase $useCase
    ) {}
    public function handle(Request $request): RedirectResponse
    {
        $response = $this->useCase->execute($request->all());
        return redirect('/')->with('response-data', $response);;
    }
}

<?php

namespace App\Http\Controllers\Webhook;

use App\UseCase\Pedido\AlterarStatusPedidoUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlterarStatusPedidoController
{
    public function __construct(
        private readonly AlterarStatusPedidoUseCase $useCase
    ) {}

    public function handle(Request $request): JsonResponse
    {
        $response = $this->useCase->execute($request->all());
        return response()->json($response);
    }
}

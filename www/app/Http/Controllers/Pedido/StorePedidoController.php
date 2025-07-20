<?php
namespace App\Http\Controllers\Pedido;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StorePedidoController
{
    public function handle(Request $request): View
    {
        dd($request->all());
        return view('produtos.index');
    }
}

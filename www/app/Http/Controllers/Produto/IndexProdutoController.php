<?php

namespace App\Http\Controllers\Produto;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class IndexProdutoController extends Controller
{
    public function handle(): View
    {
        return view('produto.create');
    }
}

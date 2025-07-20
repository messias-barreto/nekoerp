<?php

namespace App\Providers;

use App\Interfaces\CupomInterface;
use App\Interfaces\EstoqueInterface;
use App\Interfaces\PedidoInterface;
use App\Interfaces\ProdutoInterface;
use App\Interfaces\VariacaoProdutoInterface;
use App\Repository\CupomRepository;
use App\Repository\EstoqueRepository;
use App\Repository\PedidoRepository;
use App\Repository\ProdutoRepository;
use App\Repository\VariacaoProdutoRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProdutoInterface::class, ProdutoRepository::class);
        $this->app->bind(EstoqueInterface::class, EstoqueRepository::class);
        $this->app->bind(VariacaoProdutoInterface::class, VariacaoProdutoRepository::class);
        $this->app->bind(CupomInterface::class, CupomRepository::class);
        $this->app->bind(PedidoInterface::class, PedidoRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}

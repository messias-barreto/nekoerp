@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Lista de Produtos no Carrinho -->
    <div class="container py-1">
        <h2 class="mb-4">Carrinho de Compras</h2>

        <!-- Lista de Produtos no Carrinho -->
        <div class="card mb-4">
            <div class="card-header">
                Produtos no Carrinho
            </div>
            <div class="card-body">
                @forelse ($response['data']['produtos'] ?? [] as $item)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div>
                        <strong>{{ $item['name'] }}</strong><br>
                        <small>Preço: R$ {{ number_format($item['price'], 2, ',', '.') }}</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <form action=" {{ route('carrinho.remove-quantidade-produto') }}" method="POST" class="me-2">
                            @csrf
                            <input type="hidden" name="produto_id" value="{{ $item['id'] }}" />
                            <button class="btn btn-outline-danger btn-sm">-</button>
                        </form>

                        <span class="mx-2">{{ $item['qtd'] }}</span>

                        <form action=" {{ route('carrinho.add-quantidade-produto') }}" method="POST">
                            @csrf
                            <input type="hidden" name="produto_id" value="{{ $item['id'] }}" />
                            <button class="btn btn-outline-success btn-sm">+</button>
                        </form>
                    </div>
                </div>
                @empty
                <p>O carrinho está vazio.</p>
                @endforelse
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between">
                <strong>Subtotal:</strong>
                <span>
                    R$ {{ number_format($response['data']['subtotal'], 2, ',','.') }}
                </span>
            </div>
        </div>

        <!-- Cupom de Desconto -->
        <div class="card mb-4">
            <div class="card-header">Cupom de Desconto</div>
            <div class="card-body">
                @if(isset($response['data']['cupom']))
                <x-form-remover-cupom-desconto :nome="$response['data']['cupom']['name']" :desconto="$response['data']['cupom']['desconto']" />
                @else
                <x-form-aplicar-cupom-desconto />
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between">
                <strong>Frete:</strong>
                <span>
                    R$ {{ $response['data']['frete'] }}
                </span>
            </div>
        </div>

        <!-- Totais -->
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between">
                <strong>Total:</strong>
                @if(isset($response['data']['subtotalComDesconto']))
                    <span>
                        <s>R$ {{ $response['data']['total'] }}</s>
                        <br>
                        <small class="text-success">Com desconto: <strong>R$ {{ number_format($response['data']['subtotalComDesconto'], 2, ',', '.') }}</strong></small>
                    </span>
                @else
                    <span>
                        R$ <strong>{{ $response['data']['total'] }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <!-- Dados do Cliente -->
        <div class="card">
            <div class="card-header">Dados do Cliente</div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="client_name" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="client_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" name="cep" required>
                    </div>

                    <button class="btn btn-success">Finalizar Pedido</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

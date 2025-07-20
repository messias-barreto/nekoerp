@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Pedidos</h2>

    @forelse ($response['data'] as $pedido)
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <strong>Pedido #{{ $pedido->id }}</strong><br>
                <small>Realizado em: {{ $pedido->created_at->format('d/m/Y H:i') }}</small>
            </div>
            <span class="badge bg-primary">{{ ucfirst($pedido->status) }}</span>
        </div>
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ $pedido->client_name }} ({{ $pedido->client_email }})</p>
            <p><strong>Endereço:</strong> {{ $pedido->logradouro }}, {{ $pedido->complemento }} - {{ $pedido->bairro }} - {{ $pedido->localidade }}/{{ $pedido->uf }}</p>
            <p><strong>Total:</strong> R$ {{ $pedido->valor_pedido }}</p>

            <hr>

            <h5>Produtos:</h5>
            @foreach ([] as $produto)
            <div class="d-flex justify-content-between border-bottom py-2">
                <div>
                    <strong>{{ $produto->name }}</strong><br>
                    <small>Preço unitário: R$ {{ number_format($produto->price, 2, ',', '.') }}</small>
                </div>
                <div>
                    <span>Quantidade: {{ $produto->pivot->qtd }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @empty
    <div class="alert alert-info">
        Nenhum pedido encontrado.
    </div>
    @endforelse
</div>
@endsection

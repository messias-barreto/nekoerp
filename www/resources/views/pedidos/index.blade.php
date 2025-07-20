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

            <span   @if($pedido->status == 'pendente') class="badge bg-primary"
                    @elseif($pedido->status == 'cancelado') class="badge bg-danger"
                    @else class="badge bg-success"
                    @endif
            >{{ ucfirst($pedido->status) }}</span>
        </div>
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ $pedido->client_name }} ({{ $pedido->client_email }})</p>
            <p><strong>Endereço:</strong> {{ $pedido->logradouro }}, {{ $pedido->complemento }} - {{ $pedido->bairro }} - {{ $pedido->localidade }}/{{ $pedido->uf }}</p>
            <p><strong>Subtotal:</strong> R$ {{ $pedido->valor_subtotal }}</p>
            <p><strong>Frete:</strong> R$ {{ $pedido->valor_frete }}</p>
            <p><strong>Total:</strong> R$
                @if($pedido->valor_desconto > 0)
                <span>
                    <s>R$ {{ $pedido->valor_total }}</s>
                    <br>
                    <p class="text-success">Com desconto: <strong>R$ {{ $pedido->valor_desconto }}</strong></p>
                </span>
                @else
                    <strong>{{ $pedido->valor_total }}</strong>
                @endif
            </p>
        </div>
    </div>
    @empty
    <div class="alert alert-info">
        Nenhum pedido encontrado.
    </div>
    @endforelse
</div>
@endsection

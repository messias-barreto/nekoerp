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
                @if (session('response-data') !== NULL)
                    <x-alert :retorno="session('response-data')['success']" :message="session('response-data')['message']"></x-alert>
                @endif
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
                <x-form-aplicar-cupom-desconto :isprodutos="count($response['data']['produtos'])" />
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
                @if(isset($response['data']['cupom']))
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
                <form action="{{ route('pedido.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="valor_subtotal" id="valor_subtotal" value="{{ number_format($response['data']['subtotal'], 2, ',','.') }}">
                    <input type="hidden" name="valor_total" id="valor_total" value="{{ $response['data']['total'] }}">
                    <input type="hidden" name="valor_frete" id="valor_frete" value="{{ $response['data']['frete'] }}">
                    @if(isset($response['data']['cupom']))
                        <input type="hidden" name="valor_desconto" id="valor_desconto" value="{{ number_format($response['data']['subtotalComDesconto'], 2, ',', '.') }}">
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="client_name" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="client_name" required>
                        </div>

                        <div class="col-md-6">
                            <label for="client_email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="client_email" required>
                        </div>

                        <div class="col-md-6">
                            <label for="cep" class="form-label">CEP</label>
                            <div class="input-group">
                                <input type="text" class="form-control border-primary" name="cep" id="cep" placeholder="Digite o CEP" required>
                                <button type="button" class="btn btn-primary" onclick="buscarCep()">Buscar CEP</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="logradouro" class="form-label">Logradouro</label>
                            <input type="text" class="form-control" name="logradouro" id="logradouro" required>
                        </div>

                        <div class="col-md-4">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control" name="complemento" id="complemento" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control" name="bairro" id="bairro" required>
                        </div>

                        <div class="col-md-4">
                            <label for="localidade" class="form-label">Localidade</label>
                            <input type="text" class="form-control" name="localidade" id="localidade" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="uf" class="form-label">UF</label>
                            <input type="text" class="form-control" name="uf" id="uf" required>
                        </div>

                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado</label>
                            <input type="text" class="form-control" name="estado" id="estado" required>
                        </div>

                        <div class="col-md-6">
                            <label for="regiao" class="form-label">Região</label>
                            <input type="text" class="form-control" name="regiao" id="regiao" required>
                        </div>
                    </div>

                    <button class="btn btn-success" @if(count($response['data']['produtos']) == 0) disabled @endif>Finalizar Pedido</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/obterDadosClienteViaCep.js') }}"></script>
@endpush

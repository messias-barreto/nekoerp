@extends('layouts.app')

@section('title', 'Cadastrar Produto - NekoERP')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-light d-flex align-items-center">
            <img src="/img/logo.png" alt="NekoERP" height="40" class="me-2">
            <h4 class="mb-0">Cadastrar Produto - NekoERP</h4>
        </div>

        <div class="card-body">
            <form action=" {{ route ('produtos.store') }}" method="POST">
                @csrf

                {{-- Nome do Produto --}}
                <div class="mb-3">
                    <label for="product_name" class="form-label">Nome do Produto</label>
                    <input type="text" name="name" id="product_name" class="form-control" required>
                </div>

                 <div class="mb-3">
                    <label for="price" class="form-label">Preço do Produto</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Quantidade em Estoque</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>

                {{-- Tipo do Produto --}}
                <div class="mb-3">
                    <label for="product_type" class="form-label">Tipo do Produto</label>
                    <select name="type" id="product_type" class="form-control" required>
                        <option value="" disabled selected>Selecione o tipo</option>
                        <option value="shonen">Shonen</option>
                        <option value="shoujo">Shoujo</option>
                        <option value="seinen">Seinen</option>
                        <option value="josei">Josei</option>
                        <option value="isekai">Isekai</option>
                    </select>
                </div>

                {{-- Variações --}}
                <div class="mb-4">
                    <label class="form-label">Variações</label>
                    <table class="table table-bordered" id="variations-table">
                        <thead class="table-light">
                            <tr>
                                <th>Nome da Variação</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="variations[0][name]" class="form-control">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remover</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" id="add-variation" class="btn btn-outline-secondary btn-sm mt-2">+ Adicionar Variação</button>
                </div>

                {{-- Botões --}}
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Cadastrar Produto</button>
                    <button type="button" class="btn btn-primary" id="buy-product">Comprar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let variationIndex = 1;

    document.getElementById('add-variation').addEventListener('click', function () {
        const tbody = document.querySelector('#variations-table tbody');
        const newRow = `
            <tr>
                <td><input type="text" name="variations[${variationIndex}][name]" class="form-control"></td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row">Remover</button>
                </td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', newRow);
        variationIndex++;
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });

    document.getElementById('buy-product').addEventListener('click', function () {
        alert('Produto adicionado ao carrinho! (implementação futura)');
    });
</script>
@endpush
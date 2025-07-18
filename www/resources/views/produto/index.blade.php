@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>Lista de Mangás</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateProduct">Cadastrar
                Mangá</button>
        </div>

        <div class="row" id="product-list">
            @forelse($response['products'] as $product)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title text-primary fw-bold">
                                    <i class="bi bi-book-half me-1"></i>{{ $product->name }}
                                </h5>
                                <p class="card-text text-muted">
                                    <i class="bi bi-cash-coin me-1"></i>
                                    <strong>R$ {{ number_format($product->price, 2, ',', '.') }}</strong>
                                </p>
                            </div>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-box-seam me-1"></i> Estoque: {{ $product->stock ?? 150 }}
                                </span>
                                <button class="btn btn-warning btn-sm btn-add-cart">
                                    <i class="bi bi-cart-plus me-1"></i> Adicionar
                                </button>
                                <button class="btn btn-success btn-sm btn-edit-cart" data-id="{{ $product->id }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditProduct"
                                    data-name="{{ $product->name }}"
                                    data-price="{{ $product->price }}"
                                    data-stock="{{ $product->stock ?? 150 }}"
                                    data-type="{{ $product->type }}">
                                    <i class="bi bi-pen me-1"></i> Editar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Nenhum mangá cadastrado.</p>
                </div>
            @endforelse

            <div class="col-12 d-flex justify-content-center mt-4">
                {{ $response['products']->links() }}
            </div>
        </div>

        <!-- Modal de Cadastro -->
        <x-modal-cadastro-produto></x-modal-cadastro-produto>
        <x-modal-editar-produto></x-modal-editar-produto>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let cart = {};

            $('.btn-add-cart').click(function() {
                const productId = $(this).data('id');
                const quantity = parseInt($(`.quantity-input[data-id="${productId}"]`).val());

                if (!cart[productId]) {
                    cart[productId] = quantity;
                } else {
                    cart[productId] += quantity;
                }

                alert(`Produto adicionado ao carrinho. Quantidade atual: ${cart[productId]}`);
                console.log(cart);
            });
        });
    </script>

    <script>
        let variationIndex = 1;

        document.getElementById('add-variation').addEventListener('click', function() {
            const tbody = document.querySelector('#variations-table tbody');
            const newRow = `
            <tr>
                <td><input type="text" name="variations[${variationIndex}][name]" class="form-control" required></td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row">Remover</button>
                </td>
            </tr>
        `;
            tbody.insertAdjacentHTML('beforeend', newRow);
            variationIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
            }
        });

        document.getElementById('buy-product').addEventListener('click', function() {
            alert('Produto adicionado ao carrinho! (implementação futura)');
        });
    </script>

    <script>
        $(document).ready(function() {
            let cart = {};

            // Adiciona ao carrinho
            $('.btn-add-cart').click(function() {
                const productId = $(this).data('id');
                const quantity = parseInt($(`.quantity-input[data-id="${productId}"]`).val());

                if (!cart[productId]) {
                    cart[productId] = quantity;
                } else {
                    cart[productId] += quantity;
                }

                alert(`Produto adicionado ao carrinho. Quantidade atual: ${cart[productId]}`);
                console.log(cart);
            });

            // Lógica para adicionar/remover variações
            let variationIndex = 1;

            $('#add-variation').on('click', function() {
                const row = `
                <tr>
                    <td><input type="text" name="variations[${variationIndex}][name]" class="form-control" required></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row">Remover</button>
                    </td>
                </tr>
            `;
                $('#variations-table tbody').append(row);
                variationIndex++;
            });

            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.btn-edit-cart');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const price = this.getAttribute('data-price');
                    const stock = this.getAttribute('data-stock');
                    const type = this.getAttribute('data-type');

                    console.log(stock);
                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-name').value = name;
                    document.getElementById('edit-price').value = price;
                    document.getElementById('edit-stock').value = stock;

                    const select = document.getElementById('edit-type');
                    console.log(select);
                    if (select) {
                        select.value = type;
                    }
                });
            });
        });
    </script>
@endpush

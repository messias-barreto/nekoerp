
@props(['id' => null, 'name' => null, 'price' => null, 'stock' => null])

<div class="modal fade" id="modalEditProduct" tabindex="-1" aria-labelledby="modalEditProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('produtos.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Editar Mangá - NekoERP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">

                    {{-- Nome do Produto --}}
                    <div class="mb-3">
                        <label for="product_name" class="form-label">
                            <i class="bi bi-book"></i> Nome do Produto
                            Nome do Produto
                        </label>
                        <input type="text" name="name" id="edit-name" class="form-control" required value="{{ $name }}"/>
                    </div>

                    {{-- Preço --}}
                    <div class="mb-3">
                        <label for="price" class="form-label">
                            <i class="bi bi-currency-dollar"></i> Preço do produtos
                        </label>
                        <input type="number" step="0.01" name="price" id="edit-price" value="{{ $price }}" class="form-control" required>
                    </div>

                    {{-- Estoque --}}
                    <div class="mb-3">
                        <label for="stock" class="form-label">
                            <i class="bi bi-box-seam"></i> Quantidade em Estoque
                        </label>
                        <input type="number" name="stock" id="edit-stock" class="form-control" required>
                    </div>

                    {{-- Tipo --}}
                    <div class="mb-3">
                        <label for="product_type" class="form-label">
                            <i class="bi bi-tags"></i> Tipo do produtos
                        </label>
                        <select name="type" id="edit-type" class="form-control" required>
                            <option value="shonen">Shonen</option>
                            <option value="shoujo">Shoujo</option>
                            <option value="seinen">Seinen</option>
                            <option value="josei">Josei</option>
                            <option value="isekai">Isekai</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Editar Mangá
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

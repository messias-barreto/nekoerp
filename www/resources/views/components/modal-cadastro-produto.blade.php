<div class="modal fade" id="modalCreateProduct" tabindex="-1" aria-labelledby="modalCreateProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('produtos.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Cadastrar Mangá - NekoERP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">

                    {{-- Nome do Produto --}}
                    <div class="mb-3">
                        <label for="product_name" class="form-label">
                            <i class="bi bi-book"></i> Nome do Produto
                            Nome do Produto
                        </label>
                        <input type="text" name="name" id="product_name" class="form-control" required>
                    </div>

                    {{-- Preço --}}
                    <div class="mb-3">
                        <label for="price" class="form-label">
                            <i class="bi bi-currency-dollar"></i> Preço do produtos
                        </label>
                        <input type="number" step="0.01" min="1.00" name="price" class="form-control" required>
                    </div>

                    {{-- Estoque --}}
                    <div class="mb-3">
                        <label for="stock" class="form-label">
                            <i class="bi bi-box-seam"></i> Quantidade em Estoque
                        </label>
                        <input type="number" min="1" name="stock" class="form-control" required>
                    </div>

                    {{-- Tipo --}}
                    <div class="mb-3">
                        <label for="product_type" class="form-label">
                            <i class="bi bi-tags"></i> Tipo do produtos
                        </label>
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
                        <label class="form-label">
                            <i class="bi bi-sliders"></i>Variações
                        </label>
                        <table class="table table-bordered" id="variations-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Nome da Variação</th>
                                    <th style="width: 100px;">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="variations[0][name]" class="form-control" required>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm remove-row">Remover</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" id="add-variation" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-plus-lg"></i> Adicionar Variação
                        </button>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Cadastrar Mangá
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

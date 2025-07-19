@props(['id'])

<form action="{{ route('carrinho.store') }}" method="POST">
    @csrf
    <div class="modal-footer d-flex justify-content-between">
        <input type="hidden" name="produto-id" id="produto-id" value="{{ $id }}" class="form-control">

        <button type="submit" class="btn btn-warning btn-sm btn-add-cart">
            <i class="bi bi-cart-plus me-1"></i> Adicionar
        </button>
    </div>
</form>

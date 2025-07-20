<form action="{{ route('carrinho.aplicar-cupom' )}}" method="POST">
    @csrf
    <div class="input-group">
        <input type="text" name="cupom" class="form-control" placeholder="Digite o código do cupom" required>
        <button class="btn btn-primary">Aplicar</button>
    </div>
</form>

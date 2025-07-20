@props([
    'isprodutos'
])

<form action="{{ route('carrinho.aplicar-cupom' )}}" method="POST">
    @csrf
    <div class="input-group">
        <input  type="text"
                name="cupom"
                class="form-control"
                placeholder="Digite o código do cupom"
                required
                @if($isprodutos <= 0) disabled @endif
        >
        <button class="btn btn-primary" @if($isprodutos <= 0) disabled @endif>Aplicar</button>
    </div>
</form>

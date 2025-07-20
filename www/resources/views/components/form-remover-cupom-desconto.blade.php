@props([
'nome',
'desconto'
])

<form action="{{ route('carrinho.remover-cupom' )}}" method="POST">
    @csrf
    <div class="input-group mb-2">
        <button class="btn btn-danger">Remover</button>
    </div>
    <span>
        <strong>Cupom aplicado:</strong> {{ $nome }}
        <span class="ms-2 badge bg-success">{{ $desconto }}% de desconto</span>
    </span>
</form>

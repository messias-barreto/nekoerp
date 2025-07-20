<?php

namespace App\UseCase\Carrinho;

use App\Interfaces\CupomInterface;
use Illuminate\Support\Facades\Session;

class RemoverCupomDescontoUseCase
{
    public function __construct(
        private readonly Session $session,
        private readonly CupomInterface $cupomRepository
    ) {}

    public function execute(): array
    {
        $carrinho = $this->session::get('carrinho-produtos');
        if(isset($carrinho['cupom'])) {
            $cupom = $this->cupomRepository->findByName($carrinho['cupom']['name']);
            $quantidade = $cupom->quantidade + 1;
            $this->cupomRepository->alterarQuantidade($cupom->id, $quantidade);
            unset($carrinho['cupom']);
        }

        if(isset($carrinho['subtotalComDesconto'])) {
            unset($carrinho['subtotalComDesconto']);
        }

        $this->session::put('carrinho-produtos', $carrinho);

        return [
            'success' => true,
            'message' => 'Cupom Removido com Sucesso'
        ];
    }
}

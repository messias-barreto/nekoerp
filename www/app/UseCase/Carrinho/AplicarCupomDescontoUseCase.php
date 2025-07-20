<?php

namespace App\UseCase\Carrinho;

use App\Interfaces\CupomInterface;
use Illuminate\Support\Facades\Session;

class AplicarCupomDescontoUseCase
{

    public function __construct(
        private readonly Session $session,
        private readonly CupomInterface $cupomRepository
    ) {}
    public function execute(array $data): array
    {
        $cupom = $this->cupomRepository->findByName($data['cupom']);
        if(empty($cupom)) {
            return [
                'success' => false,
                'message' => 'Cupom Não Foi Encontrado!'
            ];
        }

        $carrinho = $this->session::get('carrinho-produtos');
        $carrinho['cupom'] = array(
            'name' => $cupom->name,
            'desconto' => $cupom->valor
        );

        $this->session::put('carrinho-produtos', $carrinho);
        return [];
    }
}

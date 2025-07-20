<?php

namespace App\UseCase\Carrinho;

use App\Interfaces\CupomInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AplicarCupomDescontoUseCase
{

    public function __construct(
        private readonly Session $session,
        private readonly CupomInterface $cupomRepository,
        private readonly Carbon $carbon
    ) {}
    public function execute(array $data): array
    {
        $cupom = $this->cupomRepository->findByName($data['cupom']);
        if (empty($cupom)) {
            return [
                'success' => false,
                'message' => 'Cupom Não Foi Encontrado!'
            ];
        }

        if ($cupom->quantidade == 0) {
            return [
                'success' => false,
                'message' => 'Quantidade Do Cupom Solicitado Já foi utilizada!'
            ];
        }

        $cupomExpirado = $this->verificarDataExpiracaoCupom($cupom->data_expiracao);
        if ($cupomExpirado) {
            return [
                'success' => false,
                'message' => 'Cupom Solicitado consta como Inspirado!'
            ];
        }

        $carrinho = $this->session::get('carrinho-produtos');
        $carrinho['cupom'] = array(
            'name' => $cupom->name,
            'desconto' => $cupom->valor
        );

        $quantidadeCupom = $cupom->quantidade - 1;
        $this->cupomRepository->alterarQuantidade($cupom->id, $quantidadeCupom);
        $this->session::put('carrinho-produtos', $carrinho);

        return [
            'success' => true,
            'message' => 'Cupom Foi Aplicado.'
        ];
    }

    public function verificarDataExpiracaoCupom(string $dataCupom): bool
    {
        return $this->carbon::parse($dataCupom)->isPast();
    }
}

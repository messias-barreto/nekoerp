<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Status do Pedido</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f2f2f2; font-family: Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 8px rgba(0,0,0,0.1); padding: 30px;">
                    <tr>
                        <td>
                            <h2 style="color: #2c3e50; margin-bottom: 10px;">Olá {{ $dados['data']['client_name'] }},</h2>
                            <p style="font-size: 15px; color: #555;">Segue o status atualizado do seu pedido:</p>

                            <h3 style="color: #333; margin-top: 30px;">Pedido #{{ $dados['data']['id'] }}</h3>
                            <p style="color: #666;"><strong>Realizado em:</strong> {{ $dados['data']['created_at'] }}</p>

                            <p>
                                <strong>Status:</strong>
                                <span style="
                                    display: inline-block;
                                    padding: 6px 12px;
                                    border-radius: 4px;
                                    color: #fff;
                                    font-weight: bold;
                                    font-size: 13px;
                                    @if($dados['data']['status'] === 'pendente') background-color: #0d6efd;
                                    @elseif($dados['data']['status'] === 'cancelado') background-color: #dc3545;
                                    @else background-color: #198754;
                                    @endif
                                ">
                                    {{ ucfirst($dados['data']['status']) }}
                                </span>
                            </p>

                            <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">

                            <p style="color: #333;"><strong>Cliente:</strong> {{ $dados['data']['client_name'] }} ({{ $dados['data']['client_email'] }})</p>
                            <p style="color: #333;"><strong>Endereço:</strong> {{ $dados['data']['logradouro'] }}, {{ $dados['data']['complemento'] }} - {{ $dados['data']['bairro'] }} - {{ $dados['data']['localidade'] }}/{{ $dados['data']['uf'] }}</p>

                            <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">

                            <p style="color: #333;"><strong>Subtotal:</strong> R$ {{ $dados['data']['valor_subtotal'] }}</p>
                            <p style="color: #333;"><strong>Frete:</strong> R$ {{ $dados['data']['valor_frete'] }}</p>

                            <p style="color: #333;"><strong>Total:</strong><br>
                                @if(isset($dados['data']['valor_desconto']) && $dados['data']['valor_desconto'] > 0)
                                <s style="color: #888;">R$ {{ $dados['data']['valor_total'] }}</s><br>
                                <span style="color: #198754; font-weight: bold;">Com desconto: R$ {{ $dados['data']['valor_desconto'] }}</span>
                                @else
                                <strong>R$ {{ $dados['data']['valor_total'] }}</strong>
                                @endif
                            </p>

                            <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 30px;">

                            <p style="font-size: 14px; color: #555;">Obrigado por comprar conosco!</p>

                            <p style="margin-top: 30px; font-size: 14px; color: #555;">Atenciosamente,<br>
                                <strong>Equipe NekoERP</strong></p>
                        </td>
                    </tr>
                </table>
                <p style="font-size: 12px; color: #999; margin-top: 10px;">© {{ now()->year }} NekoERP. Todos os direitos reservados.</p>
            </td>
        </tr>
    </table>
</body>
</html>

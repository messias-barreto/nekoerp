async function buscarCep() {
    const cepInput = document.getElementById('cep');
    const cep = cepInput.value.replace(/\D/g, '');

    if (cep.length !== 8) {
        alert('CEP inválido. Deve conter 8 dígitos.');
        return;
    }

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        if (data.erro) {
            alert('CEP não encontrado.');
            return;
        }

        document.getElementById('logradouro').value = data.logradouro || '';
        document.getElementById('complemento').value = data.complemento || '';
        document.getElementById('bairro').value = data.bairro || '';
        document.getElementById('localidade').value = data.localidade || '';
        document.getElementById('uf').value = data.uf || '';
        document.getElementById('estado').value = data.estado || '';
        document.getElementById('regiao').value = data.regiao || '';

    } catch (error) {
        console.error('Erro no fetch:', error);
        alert('Erro ao buscar o CEP. Tente novamente.');
    }
}

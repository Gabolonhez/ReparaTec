var rodape = document.getElementById('rodape');
rodape.classList.add('esconder');
if (rodape.innerHTML.trim() !== '') {
    rodape.classList.remove('esconder');
    setTimeout(function() {
        rodape.classList.add('esconder');
    }, 3000);
}

function mostrarMsg() {
    rodape.classList.remove('esconder');
    setTimeout(function() {
        rodape.classList.add('esconder');
    }, 3000);
}

function buscarCEP(cep) {
    cep = cep.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    if (cep != "") {
        let script = document.createElement('script');
        script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=preencherFormulario';
        document.body.appendChild(script);
    }
}
function preencherFormulario(conteudo) {
    if (!("erro" in conteudo)) {
        document.getElementById('rua').value = conteudo.logradouro;
        document.getElementById('bairro').value = conteudo.bairro;
        document.getElementById('cidade').value = conteudo.localidade;
        document.getElementById('estado').value = conteudo.uf;
    } else {
        alert("CEP não encontrado.");
        document.getElementById('rua').value = "";
        document.getElementById('bairro').value = "";
        document.getElementById('cidade').value = "";
        document.getElementById('estado').value = "";
    }
}


function mascaraCPF(cpfField) {
    var cpf = cpfField.value;
    // Remove qualquer caractere não numérico
    cpf = cpf.replace(/\D/g, '');
    // Formata o CPF com pontos e traço
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    // Atualiza o valor do campo
    cpfField.value = cpf;
}

function validarCPF(cpfField) {
    var cpf = cpfField.value;
    // Remove pontos e traços
    cpf = cpf.replace(/\D/g, '');
    // Verifica se o CPF tem 11 dígitos
    if (cpf.length !== 11) {
        alert('CPF inválido');
        return false;
    }
    // Verifica se todos os dígitos são iguais
    if (/^(\d)\1+$/.test(cpf)) {
        alert('CPF inválido');
        return false;
    }
    // Valida os dígitos verificadores
    var soma = 0;
    var resto;
    for (var i = 1; i <= 9; i++) {
        soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) {
        resto = 0;
    }
    if (resto !== parseInt(cpf.substring(9, 10))) {
        alert('CPF inválido');
        return false;
    }
    soma = 0;
    for (var i = 1; i <= 10; i++) {
        soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) {
        resto = 0;
    }
    if (resto !== parseInt(cpf.substring(10, 11))) {
        alert('CPF inválido');
        return false;
    }
    alert('CPF válido');
    return true;
}

function formatNumber(input) {
    let value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    let decimalPart = value.slice(-2); // Pega os últimos dois dígitos como a parte decimal
    let integerPart = value.slice(0, -2); // Pega os dígitos restantes como a parte inteira
    let formattedValue = '';

    // Formata a parte inteira com separador de milhares
    formattedValue = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, "."); 

    // Adiciona a parte decimal com a vírgula
    if (decimalPart.length > 0) {
        formattedValue += ',' + decimalPart;
    }

    input.value = formattedValue;
}
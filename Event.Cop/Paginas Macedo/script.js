document.addEventListener("DOMContentLoaded", function() {
  console.log("Script carregado com sucesso!");
});

document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector(".form-wizard");
  if (!form) return;

  const steps = Array.from(form.querySelectorAll(".cadastro_evento"));
  const btnAvancarList = form.querySelectorAll(".btn_avancar");
  const btnVoltarList = form.querySelectorAll(".btn_voltar");

  let currentStep = 0;

  const updateSteps = () => {
    steps.forEach((step, index) => {
      if (index === currentStep) {
        step.removeAttribute("hidden");
        step.classList.add("active");
      } else {
        step.setAttribute("hidden", "");
        step.classList.remove("active");
      }
    });
  };

  const validateCurrentStep = () => {
    const currentFields = steps[currentStep].querySelectorAll("input, select, textarea");
    for (const field of currentFields) {
      if (!field.checkValidity()) {
        field.reportValidity(); 
        return false;
      }
    }
    return true;
  };

  btnAvancarList.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      if (validateCurrentStep()) {
        if (currentStep < steps.length - 1) {
          currentStep++;
          updateSteps();
        }
      }
    });
  });


  btnVoltarList.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      if (currentStep > 0) {
        currentStep--;
        updateSteps();
      }
    });
  });

  updateSteps();
});

document.addEventListener('DOMContentLoaded', () => {
    const btnPix = document.querySelector('#pix button');
    const btnCartao = document.querySelector('#cartao button');
    const btnBoleto = document.querySelector('#boleto button');

    if (btnPix) btnPix.addEventListener('click', () => mostrarPagamento('pix'));
    if (btnCartao) btnCartao.addEventListener('click', () => mostrarPagamento('cartao'));
    if (btnBoleto) btnBoleto.addEventListener('click', () => mostrarPagamento('boleto'));
});

function mostrarPagamento(opcao) {
    document.getElementById('sec-cartao').hidden = true;
    document.getElementById('sec-pix').hidden = true;
    document.getElementById('sec-boleto').hidden = true;
    if (opcao === 'pix') {
        document.getElementById('sec-pix').hidden = false;
    } else if (opcao === 'cartao') {
        document.getElementById('sec-cartao').hidden = false;
    } else if (opcao === 'boleto') {
        document.getElementById('sec-boleto').hidden = false;
    }
}

document.addEventListener("DOMContentLoaded", function() {
    console.log("Script carregado com sucesso!");

    // Procura o botão pelo ID e adiciona o evento de clique via JS
    const botaoCopiar = document.getElementById('copiar');
    
    if (botaoCopiar) {
        botaoCopiar.addEventListener('click', copiarCodigo);
    }
});

function copiarCodigo() {
    const inputElement = document.getElementById('copia-input');
    const botao = document.getElementById('copiar');
    if (!inputElement || !botao) return;
    const textoBotao = botao.querySelector('.texto-botao');

    navigator.clipboard.writeText(inputElement.value).then(() => {
        if (textoBotao) {
            const textoOriginal = textoBotao.textContent;
            textoBotao.textContent = 'Copiado!';
            botao.style.backgroundColor = '#2d6a4f'; // Verde de sucesso
            setTimeout(() => {
                textoBotao.textContent = textoOriginal;
                botao.style.backgroundColor = ''; // Volta ao normal
            }, 2000);
        } else {
            alert("Código copiado com sucesso!");
        }
    }).catch(err => {
        console.error('Erro ao tentar copiar: ', err);
        alert('Não foi possível copiar automaticamente.');
    });
}
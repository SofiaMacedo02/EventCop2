// Scripts Gerais do Módulo Macedo (Wizard e Pagamento) - EventCop

document.addEventListener("DOMContentLoaded", () => {
    // === 1. Assistente Multi-Etapas (Form Wizard) ===
    const form = document.querySelector(".form-wizard");
    if (form) {
        const steps = Array.from(form.querySelectorAll(".cadastro_evento"));
        const btnAvancarList = form.querySelectorAll(".btn_avancar");
        const btnVoltarList = form.querySelectorAll(".btn_voltar");
        let currentStep = 0;

        const updateSteps = () => {
            steps.forEach((step, index) => {
                const progressBars = step.querySelectorAll(".progress");
                const progressItems = step.querySelectorAll(".progress-container ol li");

                if (index === currentStep) {
                    step.removeAttribute("hidden");
                    step.classList.add("active");

                    // Atualiza a barra de progresso
                    const percent = steps.length > 1 ? (index / (steps.length - 1)) : 1;
                    progressBars.forEach(bar => {
                        bar.style.transform = `scaleX(${percent})`;
                    });

                    // Atualiza os indicadores circulares
                    progressItems.forEach((item, itemIndex) => {
                        if (itemIndex <= index) {
                            item.classList.add("active");
                        } else {
                            item.classList.remove("active");
                        }
                    });
                } else {
                    step.setAttribute("hidden", "");
                    step.classList.remove("active");
                }
            });
        };

        const validateCurrentStep = () => {
            if (!steps[currentStep]) return true;
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
    }

    // === 2. Seletor de Formas de Pagamento (Inscrição) ===
    const btnPix = document.querySelector('#pix button');
    const btnCartao = document.querySelector('#cartao button');
    const btnBoleto = document.querySelector('#boleto button');

    if (btnPix) btnPix.addEventListener('click', () => mostrarPagamento('pix'));
    if (btnCartao) btnCartao.addEventListener('click', () => mostrarPagamento('cartao'));
    if (btnBoleto) btnBoleto.addEventListener('click', () => mostrarPagamento('boleto'));

    // Configurar botões de copiar
    const btnCopiarPix = document.getElementById('copiar-pix');
    if (btnCopiarPix) {
        btnCopiarPix.addEventListener('click', () => copiarTextoDoInput('pix-input', btnCopiarPix));
    }

    const btnCopiarBoleto = document.getElementById('copiar-boleto');
    if (btnCopiarBoleto) {
        btnCopiarBoleto.addEventListener('click', () => copiarTextoDoInput('copia-input', btnCopiarBoleto));
    }
});

function mostrarPagamento(opcao) {
    const secCartao = document.getElementById('sec-cartao');
    const secPix = document.getElementById('sec-pix');
    const secBoleto = document.getElementById('sec-boleto');
    const hiddenForma = document.getElementById('forma_pagamento_selecionada');

    if (secCartao) secCartao.hidden = true;
    if (secPix) secPix.hidden = true;
    if (secBoleto) secBoleto.hidden = true;

    if (opcao === 'pix' && secPix) {
        secPix.hidden = false;
        if (hiddenForma) hiddenForma.value = 'pix';
    } else if (opcao === 'cartao' && secCartao) {
        secCartao.hidden = false;
        if (hiddenForma) hiddenForma.value = 'cartao';
    } else if (opcao === 'boleto' && secBoleto) {
        secBoleto.hidden = false;
        if (hiddenForma) hiddenForma.value = 'boleto';
    }
}

function copiarTextoDoInput(inputId, botao) {
    const inputElement = document.getElementById(inputId);
    if (!inputElement || !botao) return;

    navigator.clipboard.writeText(inputElement.value).then(() => {
        const textoOriginal = botao.innerHTML;
        botao.innerHTML = '<span>✓</span> Copiado!';
        botao.style.backgroundColor = '#2d6a4f';
        botao.style.color = '#fff';

        setTimeout(() => {
            botao.innerHTML = textoOriginal;
            botao.style.backgroundColor = '';
            botao.style.color = '';
        }, 2500);
    }).catch(err => {
        console.error('Falha ao copiar: ', err);
        alert('Código selecionado para cópia manual.');
        inputElement.select();
    });
}

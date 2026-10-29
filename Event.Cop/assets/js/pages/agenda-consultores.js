// Script de Agendamento com Consultores - EventCop

const consultores = {
    juliana: {
        nome: "Juliana Campos",
        cargo: "Consultora de Eventos",
        dias: [1, 2, 5, 6, 8, 9, 13, 14, 15, 19, 20, 22, 23, 26, 27, 29, 30],
        limitados: [7, 12, 16, 21, 28],
        horarios: ["08:00", "09:00", "10:00", "11:00", "13:00", "14:00", "15:00", "18:00", "19:00"]
    },
    marina: {
        nome: "Marina Oliveira",
        cargo: "Consultora de Eventos",
        dias: [1, 5, 6, 8, 9, 13, 14, 15, 19, 20, 22, 26, 27, 29],
        limitados: [2, 7, 16, 21, 28, 30],
        horarios: ["08:00", "10:00", "11:00", "13:00", "14:00", "16:00", "18:00"]
    },
    rafael: {
        nome: "Rafael Santos",
        cargo: "Consultor de Negócios",
        dias: [2, 5, 6, 9, 13, 14, 16, 19, 20, 23, 27, 29, 30],
        limitados: [1, 7, 12, 15, 21, 28],
        horarios: ["09:00", "10:00", "13:00", "15:00", "17:00", "18:00", "20:00"]
    },
    isabela: {
        nome: "Isabela Ferreira",
        cargo: "Consultora de Atendimento",
        dias: [1, 2, 5, 7, 8, 13, 14, 15, 19, 21, 22, 26, 28, 29],
        limitados: [6, 9, 16, 20, 23, 30],
        horarios: ["08:00", "09:00", "11:00", "14:00", "15:00", "17:00", "19:00"]
    },
    lucas: {
        nome: "Lucas Mendes",
        cargo: "Consultor de Tecnologia",
        dias: [2, 5, 7, 9, 13, 14, 16, 19, 21, 23, 26, 28, 30],
        limitados: [1, 6, 8, 15, 20, 27, 29],
        horarios: ["09:00", "10:00", "11:00", "13:00", "16:00", "18:00"]
    },
    pedro: {
        nome: "Pedro Almeida",
        cargo: "Consultor de Soluções",
        dias: [1, 5, 6, 8, 9, 13, 15, 19, 20, 22, 26, 27, 29],
        limitados: [2, 7, 14, 16, 21, 23, 28, 30],
        horarios: ["08:00", "10:00", "13:00", "14:00", "15:00", "19:00", "20:00"]
    }
};

document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".consultor-card");
    const calendario = document.getElementById("diasCalendario");
    const listaHorarios = document.getElementById("listaHorarios");
    const dataSelecionada = document.getElementById("dataSelecionada");
    const confirmarHorario = document.getElementById("confirmarHorario");
    const mesAtualEl = document.getElementById("mesAtual");

    if (!calendario) return;

    let consultorSelecionado = "juliana";
    let diaSelecionado = null;
    let horarioSelecionado = null;

    cards.forEach(card => {
        card.addEventListener("click", function () {
            cards.forEach(outroCard => outroCard.classList.remove("ativo"));
            this.classList.add("ativo");
            consultorSelecionado = this.dataset.consultor || "juliana";
            diaSelecionado = null;
            horarioSelecionado = null;

            if (listaHorarios) listaHorarios.innerHTML = "";
            if (dataSelecionada) dataSelecionada.textContent = "Selecione uma data disponível";
            if (confirmarHorario) confirmarHorario.disabled = true;

            criarCalendario();
        });
    });

    function criarCalendario() {
        if (!calendario) return;
        calendario.innerHTML = "";
        const primeiroDiaSemana = 4; // Quinta-feira
        const totalDias = 31;

        for (let i = 0; i < primeiroDiaSemana; i++) {
            const vazio = document.createElement("div");
            vazio.classList.add("dia-vazio");
            calendario.appendChild(vazio);
        }

        const dadosConsultor = consultores[consultorSelecionado] || consultores.juliana;

        for (let dia = 1; dia <= totalDias; dia++) {
            const botao = document.createElement("button");
            botao.type = "button";
            botao.textContent = dia;
            botao.classList.add("dia");

            if (dadosConsultor.dias.includes(dia)) {
                botao.classList.add("disponivel");
                botao.addEventListener("click", () => selecionarDia(dia, botao));
            } else if (dadosConsultor.limitados.includes(dia)) {
                botao.classList.add("limitado");
                botao.addEventListener("click", () => selecionarDia(dia, botao));
            } else {
                botao.classList.add("indisponivel");
                botao.disabled = true;
            }
            calendario.appendChild(botao);
        }
    }

    function selecionarDia(dia, botao) {
        diaSelecionado = dia;
        horarioSelecionado = null;

        document.querySelectorAll(".dia").forEach(item => item.classList.remove("selecionado"));
        botao.classList.add("selecionado");

        const mesNome = mesAtualEl ? mesAtualEl.textContent : "Outubro de 2026";
        if (dataSelecionada) {
            dataSelecionada.textContent = `Dia ${dia} de ${mesNome}`;
        }
        if (confirmarHorario) {
            confirmarHorario.disabled = true;
        }
        criarHorarios();
    }

    function criarHorarios() {
        if (!listaHorarios) return;
        listaHorarios.innerHTML = "";
        const dadosConsultor = consultores[consultorSelecionado] || consultores.juliana;
        let horariosParaMostrar = dadosConsultor.horarios;

        if (dadosConsultor.limitados.includes(diaSelecionado)) {
            horariosParaMostrar = dadosConsultor.horarios.filter((_, indice) => indice % 2 === 0);
        }

        horariosParaMostrar.forEach(horario => {
            const botao = document.createElement("button");
            botao.type = "button";
            botao.textContent = horario;
            botao.classList.add("horario");
            botao.addEventListener("click", () => selecionarHorario(horario, botao));
            listaHorarios.appendChild(botao);
        });
    }

    function selecionarHorario(horario, botao) {
        horarioSelecionado = horario;
        document.querySelectorAll(".horario").forEach(item => item.classList.remove("selecionado"));
        botao.classList.add("selecionado");
        if (confirmarHorario) {
            confirmarHorario.disabled = false;
        }
    }

    if (confirmarHorario) {
        confirmarHorario.addEventListener("click", function () {
            if (diaSelecionado === null || horarioSelecionado === null) {
                if (window.EventCop && window.EventCop.toast) {
                    window.EventCop.toast("Selecione uma data e um horário para continuar.");
                }
                return;
            }

            const dadosConsultor = consultores[consultorSelecionado] || consultores.juliana;

            localStorage.setItem("consultor_agendado", dadosConsultor.nome);
            localStorage.setItem("dia_agendado", diaSelecionado);
            localStorage.setItem("horario_agendado", horarioSelecionado);

            if (window.EventCop && window.EventCop.toast) {
                window.EventCop.toast(`Reunião com ${dadosConsultor.nome} agendada!`, "ok");
            }
            mostrarModalConfirmacao(dadosConsultor.nome, diaSelecionado, horarioSelecionado);
        });
    }

    function mostrarModalConfirmacao(consultor, dia, horario) {
        let modal = document.getElementById("modal-confirmacao-agenda");
        if (!modal) {
            modal = document.createElement("div");
            modal.id = "modal-confirmacao-agenda";
            modal.style.position = "fixed";
            modal.style.top = "0";
            modal.style.left = "0";
            modal.style.width = "100%";
            modal.style.height = "100%";
            modal.style.backgroundColor = "rgba(0,0,0,0.6)";
            modal.style.display = "flex";
            modal.style.justifyContent = "center";
            modal.style.alignItems = "center";
            modal.style.zIndex = "9999";
            document.body.appendChild(modal);
        }

        modal.innerHTML = `
            <div style="background: #FFF8F2; padding: 32px; border-radius: 16px; max-width: 480px; width: 90%; text-align: center; box-shadow: 0 12px 32px rgba(90, 5, 5, 0.35); border: 2px solid #7D1A1A;">
                <div style="font-size: 48px; margin-bottom: 10px;">✅</div>
                <h2 style="color: #5A0505; margin-bottom: 10px;">Reunião Agendada com Sucesso!</h2>
                <p style="color: #5A0505; font-size: 15px; margin-bottom: 20px; line-height: 1.5;">
                    Sua conversa com <strong>${consultor}</strong> foi agendada para o <strong>dia ${dia} de Outubro de 2026</strong> às <strong>${horario}</strong>.
                </p>
                <div style="background: #FFE9DD; border: 1px solid #F4B99B; padding: 12px; border-radius: 8px; margin-bottom: 22px; font-size: 13px; color: #7D1A1A;">
                    Enviamos o link da sala virtual e as orientações para o seu WhatsApp e e-mail.
                </div>
                <button id="btnFecharModalAgenda" style="background: #7D1A1A; color: #FFF8F2; border: none; padding: 12px 30px; border-radius: 25px; font-weight: bold; cursor: pointer; font-size: 15px;">
                    Concluir e Voltar
                </button>
            </div>
        `;
        modal.style.display = "flex";

        document.getElementById("btnFecharModalAgenda").addEventListener("click", function () {
            modal.style.display = "none";
        });
    }

    criarCalendario();
});

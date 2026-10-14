const consultores = {
    juliana: {
        nome: "Juliana Campos",
        dias: [
            1, 2, 5, 6, 8, 9, 13, 14,
            15, 19, 20, 22, 23, 26, 27, 29, 30
        ],
        limitados: [
            7, 12, 16, 21, 28
        ],
        horarios: [
            "08:00", "09:00", "10:00", "11:00",
            "13:00", "14:00", "15:00",
            "18:00", "19:00"
        ]
    },
    marina: {
        nome: "Marina Oliveira",
        dias: [
            1, 5, 6, 8, 9, 13, 14,
            15, 19, 20, 22, 26, 27, 29
        ],
        limitados: [
            2, 7, 16, 21, 28, 30
        ],
        horarios: [
            "08:00", "10:00", "11:00",
            "13:00", "14:00", "16:00", "18:00"
        ]
    },
    rafael: {
        nome: "Rafael Santos",
        dias: [
            2, 5, 6, 9, 13, 14,
            16, 19, 20, 23, 27, 29, 30
        ],
        limitados: [
            1, 7, 12, 15, 21, 28
        ],
        horarios: [
            "09:00", "10:00", "13:00",
            "15:00", "17:00", "18:00", "20:00"
        ]
    },
    isabela: {
        nome: "Isabela Ferreira",
        dias: [
            1, 2, 5, 7, 8, 13,
            14, 15, 19, 21, 22, 26, 28, 29
        ],
        limitados: [
            6, 9, 16, 20, 23, 30
        ],
        horarios: [
            "08:00", "09:00", "11:00",
            "14:00", "15:00", "17:00", "19:00"
        ]
    },
    lucas: {
        nome: "Lucas Mendes",
        dias: [
            2, 5, 7, 9, 13, 14,
            16, 19, 21, 23, 26, 28, 30
        ],
        limitados: [
            1, 6, 8, 15, 20, 27, 29
        ],
        horarios: [
            "09:00", "10:00", "11:00",
            "13:00", "16:00", "18:00"
        ]
    },
    pedro: {
        nome: "Pedro Almeida",
        dias: [
            1, 5, 6, 8, 9, 13,
            15, 19, 20, 22, 26, 27, 29
        ],
        limitados: [
            2, 7, 14, 16, 21, 23, 28, 30
        ],
        horarios: [
            "08:00", "10:00", "13:00",
            "14:00", "15:00", "19:00", "20:00"
        ]
    }

};

const cards =
    document.querySelectorAll(".consultor-card");

const calendario =
    document.getElementById("diasCalendario");

const listaHorarios =
    document.getElementById("listaHorarios");

const dataSelecionada =
    document.getElementById("dataSelecionada");

const confirmarHorario =
    document.getElementById("confirmarHorario");

let consultorSelecionado = "juliana";

let diaSelecionado = null;

let horarioSelecionado = null;

cards.forEach(card => {
    card.addEventListener("click", function () {
        cards.forEach(outroCard => {
            outroCard.classList.remove("ativo");
        });
        this.classList.add("ativo");
        consultorSelecionado =
            this.dataset.consultor;
        diaSelecionado = null;
        horarioSelecionado = null;
        listaHorarios.innerHTML = "";
        dataSelecionada.textContent = "Selecione uma data disponível";
        confirmarHorario.disabled = true;
        criarCalendario();
    });

});
function criarCalendario() {
    calendario.innerHTML = "";
    const primeiroDiaSemana = 4;
    const totalDias = 31;
    for (
        let i = 0;
        i < primeiroDiaSemana;
        i++
    ) {
        const vazio = document.createElement("div");
        vazio.classList.add("dia-vazio");
        calendario.appendChild(vazio);

    }

    for (
        let dia = 1;
        dia <= totalDias;
        dia++
    ) {
        const botao = document.createElement("button");
        botao.textContent = dia;
        botao.classList.add("dia");
        const dadosConsultor = consultores[consultorSelecionado];
        if (
            dadosConsultor.dias.includes(dia)
        ) {
            botao.classList.add("disponivel");
            botao.addEventListener(
                "click",
                function () {
                    selecionarDia(
                        dia,
                        botao
                    );
                }
            );
        }
        else if (
            dadosConsultor.limitados.includes(dia)
        ) {
            botao.classList.add("limitado");
            botao.addEventListener(
                "click",
                function () {
                    selecionarDia(
                        dia,
                        botao
                    );
                }
            );
        }
        else {
            botao.classList.add("indisponivel");
            botao.disabled = true;

        }
        calendario.appendChild(botao);
    }
}

function selecionarDia(dia, botao) {
    diaSelecionado = dia;
    horarioSelecionado = null;
    document
        .querySelectorAll(".dia")
        .forEach(item => {
            item.classList.remove(
                "selecionado"
            );

        });
    botao.classList.add("selecionado");

    dataSelecionada.textContent = `Dia ${dia} de outubro de 2026`;
    confirmarHorario.disabled = true;
    criarHorarios();
}
function criarHorarios() {
    listaHorarios.innerHTML = "";
    const dadosConsultor = consultores[consultorSelecionado];
    let horariosParaMostrar = dadosConsultor.horarios;
    const diaLimitado = dadosConsultor.limitados.includes(diaSelecionado);
    if (diaLimitado) {
        horariosParaMostrar = dadosConsultor.horarios.filter(
            (horario, indice) => indice % 2 === 0
        );
    }
    horariosParaMostrar.forEach(horario => {
        const botao =ndocument.createElement("button");
        botao.textContent = horario;
        botao.classList.add("horario");
        botao.addEventListener("click", function () {
            selecionarHorario(
                horario,
                botao
            );
        });
        listaHorarios.appendChild(botao);
    });

}
function selecionarHorario(horario, botao) {
    horarioSelecionado = horario;
    document
        .querySelectorAll(".horario")
        .forEach(item => {
            item.classList.remove("selecionado");
        });
    botao.classList.add("selecionado");
    confirmarHorario.disabled = false;
}
confirmarHorario.addEventListener("click", function () {
    if (
        diaSelecionado === null ||
        horarioSelecionado === null
    ) {
        alert("Escolha uma data e um horário.");
        return;
    }
    const dadosConsultor = consultores[consultorSelecionado];
    localStorage.setItem(
        "consultor",
        dadosConsultor.nome
    );
    localStorage.setItem(
        "dia",
        diaSelecionado
    );
    localStorage.setItem(
        "horario",
        horarioSelecionado
    );
    window.location.href = "../pag6/index.php";
});



criarCalendario();
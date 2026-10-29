/**
 * Interatividade do Módulo do Organizador - EventCop
 * - Relatórios e Métricas: troca dinâmica de evento, geração e exportação CSV.
 * - Pagamentos e Pendências: filtro por evento, seletor de ano, tabela e ações rápidas.
 * - Criar Evento: wizard em 4 etapas (incluindo tela de boas-vindas) e máscara de telefone.
 */
(function () {
    'use strict';

    function notificar(msg, tipo = 'ok') {
        if (window.EventCop && typeof window.EventCop.toast === 'function') {
            window.EventCop.toast(msg, tipo);
        }
    }

    function baixarCsv(nomeArquivo, linhas) {
        const conteudo = '\uFEFF' + linhas.map((l) => l.map((c) => `"${String(c).replace(/"/g, '""')}"`).join(';')).join('\r\n');
        const blob = new Blob([conteudo], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = nomeArquivo;
        document.body.appendChild(link);
        link.click();
        link.remove();
        setTimeout(() => URL.revokeObjectURL(url), 1000);
    }

    /* ======================================================================
       1. RELATÓRIOS E MÉTRICAS
       ====================================================================== */
    function iniciarRelatorios() {
        const selectEvento = document.getElementById('selectEventoRelatorio');
        const btnExportar = document.getElementById('btnExportarRelatorio');
        const btnGerar = document.getElementById('btnGerarRelatorio');
        const banco = window.EVENTCOP_RELATORIOS || {};

        if (!selectEvento) return;

        function renderizarRelatorio(slug, comToast = true) {
            const dados = banco[slug];
            if (!dados) return;

            // 1. KPIs
            const elInscritos = document.getElementById('kpiInscritos');
            const elParticipantes = document.getElementById('kpiParticipantes');
            const elTaxa = document.getElementById('kpiTaxaPresenca');
            const elAvaliacao = document.getElementById('kpiAvaliacao');

            if (elInscritos) elInscritos.textContent = Number(dados.kpis.inscritos).toLocaleString('pt-BR');
            if (elParticipantes) elParticipantes.textContent = Number(dados.kpis.participantes).toLocaleString('pt-BR');
            if (elTaxa) elTaxa.textContent = Number(dados.kpis.taxa_presenca).toLocaleString('pt-BR', { minimumFractionDigits: 1, maximumFractionDigits: 1 }) + '%';
            if (elAvaliacao) elAvaliacao.textContent = Number(dados.kpis.avaliacao).toLocaleString('pt-BR', { minimumFractionDigits: 1, maximumFractionDigits: 1 }) + '/5';

            // 2. Evolução das inscrições (SVG)
            const poly = document.getElementById('polyEvolucao');
            const grupo = document.getElementById('grupoPontosEvolucao');
            if (poly && grupo && Array.isArray(dados.evolucao)) {
                const xs = [75, 163, 251, 339, 427, 515];
                const maxY = 400;
                const pts = dados.evolucao.map((pt, i) => {
                    const x = xs[i] || 75;
                    const y = Math.round(175 - ((pt.valor / maxY) * 140));
                    return { x, y, data: pt.data, valor: pt.valor, ultimo: i === dados.evolucao.length - 1 };
                });
                poly.setAttribute('points', pts.map((p) => `${p.x},${p.y}`).join(' '));
                grupo.innerHTML = pts.map((p) => `
                    <g class="org-svg-point-group" data-tooltip="${p.data}: ${p.valor} inscrições">
                        <line x1="${p.x}" y1="${p.y}" x2="${p.x}" y2="175" stroke="rgba(90,5,5,0.06)" stroke-width="1"/>
                        <text x="${p.x}" y="${p.y - 12}" text-anchor="middle" class="org-svg-val">${p.valor}</text>
                        <circle cx="${p.x}" cy="${p.y}" r="6.5" class="org-svg-dot ${p.ultimo ? 'is-wine' : 'is-orange'}">
                            <title>${p.data}: ${p.valor} inscrições</title>
                        </circle>
                        <text x="${p.x}" y="${p.y + 22}" text-anchor="middle" class="org-svg-date">${p.data}</text>
                    </g>
                `).join('');
            }

            // 3. Comparativo (Barras horizontais)
            const compContainer = document.getElementById('comparativoContainer');
            if (compContainer && Array.isArray(dados.comparativo)) {
                const maxEscala = dados.comparativo[0]?.max || 350;
                const passo = Math.round(maxEscala / 7);
                const escalaHtml = Array.from({ length: 8 }, (_, idx) => `<span>${idx === 7 ? maxEscala : idx * passo}</span>`).join('');

                compContainer.innerHTML = dados.comparativo.map((item) => {
                    const pct = Math.max(8, Math.min(100, ((item.valor / item.max) * 100).toFixed(1)));
                    return `
                        <div class="org-hbar-row">
                            <span class="org-hbar-label">${item.rotulo}</span>
                            <div class="org-hbar-track">
                                <div class="org-hbar-fill is-${item.cor}" style="width: ${pct}%;">
                                    <span class="org-hbar-val">${item.valor}</span>
                                </div>
                            </div>
                        </div>
                    `;
                }).join('') + `<div class="org-hbar-scale" id="comparativoScale">${escalaHtml}</div>`;
            }

            // 4. Avaliação dos participantes
            const ratingMedia = document.getElementById('ratingMedia');
            const ratingResp = document.getElementById('ratingRespondentes');
            const ratingBars = document.getElementById('ratingBarsContainer');
            if (ratingMedia) ratingMedia.textContent = dados.avaliacao.media;
            if (ratingResp) ratingResp.textContent = `${dados.avaliacao.respondentes} participantes responderam à pesquisa`;
            if (ratingBars && dados.avaliacao.estrelas) {
                ratingBars.innerHTML = [5, 4, 3, 2, 1].map((est) => {
                    const pct = dados.avaliacao.estrelas[est] ?? 0;
                    const label = est === 1 ? '1 estrela' : `${est} estrelas`;
                    return `
                        <div class="org-star-row">
                            <span class="org-star-label">${label}</span>
                            <span class="org-star-icons" aria-hidden="true">${'★'.repeat(est)}</span>
                            <div class="org-star-track">
                                <div class="org-star-fill" style="width: ${Math.max(2, pct)}%;"></div>
                            </div>
                            <strong class="org-star-pct">${pct}%</strong>
                        </div>
                    `;
                }).join('');
            }

            // 5. Interações
            const intCom = document.getElementById('intComentarios');
            const intRea = document.getElementById('intReacoes');
            const intPer = document.getElementById('intPerguntas');
            const intPes = document.getElementById('intPesquisas');
            if (intCom) intCom.textContent = dados.interacoes.comentarios;
            if (intRea) intRea.textContent = dados.interacoes.reacoes;
            if (intPer) intPer.textContent = dados.interacoes.perguntas;
            if (intPes) intPes.textContent = dados.interacoes.pesquisas;

            // 6. Insights
            const insightsContainer = document.getElementById('insightsContainer');
            if (insightsContainer && Array.isArray(dados.insights)) {
                const icones = {
                    chart: '<svg viewBox="0 0 24 24"><path d="M3 3v18h18M7 15l4-4 3 3 5-6" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                    star: '<svg viewBox="0 0 24 24"><path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="currentColor"/></svg>',
                    chat: '<svg viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" fill="currentColor"/></svg>'
                };
                insightsContainer.innerHTML = dados.insights.map((ins) => `
                    <div class="org-insight-item">
                        <span class="org-insight-icon is-${ins.cor}" aria-hidden="true">${icones[ins.icone] || icones.chart}</span>
                        <div>
                            <strong>${ins.titulo}</strong>
                            <p>${ins.texto}</p>
                        </div>
                    </div>
                `).join('');
            }

            if (comToast) {
                notificar(`Métricas carregadas: ${dados.titulo}`, 'ok');
            }
        }

        selectEvento.addEventListener('change', () => {
            renderizarRelatorio(selectEvento.value, true);
        });

        if (btnGerar) {
            btnGerar.addEventListener('click', () => {
                renderizarRelatorio(selectEvento.value, false);
                notificar('Relatório atualizado com os indicadores mais recentes!', 'ok');
            });
        }

        if (btnExportar) {
            btnExportar.addEventListener('click', () => {
                const slug = selectEvento.value;
                const d = banco[slug];
                if (!d) return;
                baixarCsv(`relatorio-${slug}.csv`, [
                    ['Evento', d.titulo],
                    ['Inscritos', d.kpis.inscritos],
                    ['Participantes Presentes', d.kpis.participantes],
                    ['Taxa de Presença (%)', d.kpis.taxa_presenca],
                    ['Avaliação Média', d.kpis.avaliacao],
                    ['Comentários', d.interacoes.comentarios],
                    ['Reações', d.interacoes.reacoes],
                    ['Perguntas Enviadas', d.interacoes.perguntas],
                    ['Pesquisas Respondidas', d.interacoes.pesquisas]
                ]);
                notificar(`Relatório de "${d.titulo}" exportado em CSV!`, 'ok');
            });
        }

        document.addEventListener('click', (ev) => {
            const pt = ev.target.closest('.org-svg-point-group');
            if (pt && pt.dataset.tooltip) {
                notificar(pt.dataset.tooltip, 'ok');
            }
        });
    }

    /* ======================================================================
       2. PAGAMENTOS E PENDÊNCIAS
       ====================================================================== */
    function iniciarPagamentos() {
        const selectFiltro = document.getElementById('selectFiltroPagamentos');
        const tabela = document.getElementById('tabelaPagamentos');
        const msgVazia = document.getElementById('msgSemPagamentos');
        const btnVerTodos = document.getElementById('btnVerTodosPagamentos');
        const selectAno = document.getElementById('selectAnoReceitas');
        const mchartBars = document.getElementById('mchartBars');

        let mostrandoTodos = false;

        function aplicarFiltroTabela(comToast = false) {
            if (!tabela) return;
            const filtro = selectFiltro ? selectFiltro.value : 'todos';
            const linhas = tabela.querySelectorAll('tbody tr');
            let visiveis = 0;

            linhas.forEach((tr) => {
                const ehExtra = tr.classList.contains('is-extra-row');
                const bateEvento = filtro === 'todos' || tr.dataset.evento === filtro;
                const mostrar = bateEvento && (filtro !== 'todos' || mostrandoTodos || !ehExtra);
                tr.hidden = !mostrar;
                if (mostrar) visiveis++;
            });

            if (msgVazia) msgVazia.hidden = visiveis > 0;
            if (comToast && selectFiltro) {
                const texto = selectFiltro.options[selectFiltro.selectedIndex]?.text || 'Todos os eventos';
                notificar(`Filtrando pagamentos: ${texto}`, 'ok');
            }
        }

        if (selectFiltro) {
            selectFiltro.addEventListener('change', () => aplicarFiltroTabela(true));
        }

        if (btnVerTodos) {
            btnVerTodos.addEventListener('click', () => {
                mostrandoTodos = !mostrandoTodos;
                btnVerTodos.textContent = mostrandoTodos ? 'Mostrar menos' : 'Ver todos';
                aplicarFiltroTabela(false);
                notificar(mostrandoTodos ? 'Exibindo histórico completo de pagamentos.' : 'Exibindo pagamentos mais recentes.', 'ok');
            });
        }

        if (selectAno && mchartBars && window.EVENTCOP_RECEITAS) {
            selectAno.addEventListener('change', () => {
                const ano = selectAno.value;
                const lista = window.EVENTCOP_RECEITAS[ano] || [];
                mchartBars.innerHTML = lista.map((m) => {
                    const hRec = ((m.recebido / 80) * 100).toFixed(1);
                    const hPen = ((m.pendente / 80) * 100).toFixed(1);
                    const hEst = ((m.estornado / 80) * 100).toFixed(1);
                    const total = m.recebido + m.pendente + m.estornado;
                    return `
                        <div class="org-mchart-col" title="${m.mes}: R$ ${total} mil">
                            <div class="org-mchart-stack">
                                <span class="org-mbar-seg is-estornado" style="height: ${hEst}%;"></span>
                                <span class="org-mbar-seg is-pendente" style="height: ${hPen}%;"></span>
                                <span class="org-mbar-seg is-recebido" style="height: ${hRec}%;"></span>
                            </div>
                            <span class="org-mchart-lbl">${m.mes}</span>
                        </div>
                    `;
                }).join('');
                notificar(`Receitas mensais de ${ano} carregadas.`, 'ok');
            });
        }

        document.addEventListener('click', (ev) => {
            const btnLinha = ev.target.closest('[data-pagamento-acao]');
            if (btnLinha) {
                const part = btnLinha.dataset.pagamentoAcao;
                const status = btnLinha.dataset.pagamentoStatus;
                const valor = btnLinha.dataset.pagamentoValor;
                notificar(`Comprovante de ${part} (${valor} • ${status}) pronto para download.`, 'ok');
                return;
            }

            const btnRapida = ev.target.closest('[data-quick-action]');
            if (btnRapida) {
                const acao = btnRapida.dataset.quickAction;
                if (acao === 'lembrete') {
                    notificar('Lembretes de pagamento enviados para os 18 inscritos pendentes!', 'ok');
                } else if (acao === 'relatorio-financeiro') {
                    baixarCsv('relatorio-financeiro-eventcop.csv', [
                        ['Indicador', 'Valor'],
                        ['Receita Total', 'R$ 287.450,00'],
                        ['Recebido', 'R$ 263.780,00'],
                        ['Pendente', 'R$ 21.350,00'],
                        ['Estornado', 'R$ 2.320,00']
                    ]);
                    notificar('Relatório financeiro baixado com sucesso!', 'ok');
                } else if (acao === 'exportar-pendencias') {
                    baixarCsv('pendencias-eventcop.csv', [
                        ['Pendência', 'Detalhe'],
                        ['18 pagamentos pendentes', 'Total de R$ 21.350,00'],
                        ['3 boletos vencidos', 'Total de R$ 4.800,00'],
                        ['5 estornos em análise', 'Solicitação em revisão'],
                        ['2 transferências aguardando confirmação', 'Total de R$ 3.600,00']
                    ]);
                    notificar('Lista de pendências exportada em CSV!', 'ok');
                } else if (acao === 'configurar-pagamento') {
                    notificar('Métodos de pagamento (Pix, Cartão e Boleto) ativos e sincronizados.', 'ok');
                }
            }
        });
    }

    /* ======================================================================
       3. WIZARD CRIAR EVENTO (4 ETAPAS)
       ====================================================================== */
    function iniciarWizardCriarEvento() {
        const form = document.getElementById('formCriarEvento');
        const main = document.getElementById('ceMain');
        if (!form) return;

        const steps = Array.from(form.querySelectorAll('[data-ce-step]'));
        let stepAtual = 0;

        function mostrarStep(indice) {
            stepAtual = Math.max(0, Math.min(steps.length - 1, indice));
            steps.forEach((el, idx) => {
                const ativo = idx === stepAtual;
                el.hidden = !ativo;
                el.classList.toggle('is-active', ativo);
            });

            if (main) {
                const ehWelcome = steps[stepAtual]?.dataset.ceStep === '4';
                main.classList.toggle('is-welcome-step', ehWelcome);
            }

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function validarStepAtual() {
            const container = steps[stepAtual];
            if (!container) return true;
            const campos = container.querySelectorAll('input, select, textarea');
            for (const campo of campos) {
                if (!campo.checkValidity()) {
                    campo.reportValidity();
                    return false;
                }
            }
            return true;
        }

        form.addEventListener('click', (ev) => {
            const btnNext = ev.target.closest('[data-ce-next]');
            if (btnNext) {
                ev.preventDefault();
                if (validarStepAtual() && stepAtual < steps.length - 1) {
                    mostrarStep(stepAtual + 1);
                }
                return;
            }

            const btnPrev = ev.target.closest('[data-ce-prev]');
            if (btnPrev) {
                ev.preventDefault();
                if (stepAtual > 0) {
                    mostrarStep(stepAtual - 1);
                }
            }
        });

        // Máscara simples de telefone brasileiro no Passo 2
        const telInput = document.getElementById('ceTelefoneOrga');
        if (telInput) {
            telInput.addEventListener('input', () => {
                let d = telInput.value.replace(/\D/g, '').slice(0, 11);
                if (d.length > 6) {
                    telInput.value = `(${d.slice(0, 2)}) ${d.slice(2, 7)}-${d.slice(7)}`;
                } else if (d.length > 2) {
                    telInput.value = `(${d.slice(0, 2)}) ${d.slice(2)}`;
                } else if (d.length > 0) {
                    telInput.value = `(${d}`;
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        iniciarRelatorios();
        iniciarPagamentos();
        iniciarWizardCriarEvento();
    });
})();

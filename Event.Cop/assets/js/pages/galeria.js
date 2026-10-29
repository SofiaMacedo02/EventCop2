/**
 * Galeria de Eventos - EventCop (assets/js/pages/galeria.js)
 * Filtragem por busca, categoria, localização, data, ordenação e alternância grade/lista.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', () => {
        const inputBusca   = document.getElementById('galeria-busca');
        const chipsCat     = document.querySelectorAll('[data-filtro-cat]');
        const selectLocal  = document.getElementById('filtro-local');
        const selectData   = document.getElementById('filtro-data');
        const selectOrdem  = document.getElementById('filtro-ordem');
        const gridTodos    = document.getElementById('grid-todos-eventos');
        const cardsTodos   = gridTodos ? Array.from(gridTodos.querySelectorAll('.evento-card')) : [];
        const msgVazio     = document.getElementById('galeria-vazio');
        const btnLimpar    = document.getElementById('btn-limpar-filtros');
        const btnVerTodos  = document.getElementById('btn-ver-todos-destaque');
        const viewBtns     = document.querySelectorAll('[data-view-mode]');
        const formNews     = document.getElementById('form-newsletter');

        let categoriaAtiva = document.querySelector('[data-filtro-cat].is-active')?.dataset.filtroCat || 'todos';

        function normalizar(str) {
            return (str || '')
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '');
        }

        function aplicarFiltros() {
            if (!gridTodos) return;

            const termo = normalizar(inputBusca ? inputBusca.value : '');
            const local = selectLocal ? selectLocal.value : '';
            const mes   = selectData ? selectData.value : '';
            const ordem = selectOrdem ? selectOrdem.value : 'recentes';

            let visiveis = 0;

            cardsTodos.forEach((card) => {
                const catCard    = card.dataset.categoria || '';
                const cidadeCard = card.dataset.cidade || '';
                const dataCard   = card.dataset.data || '';
                const textoCard  = normalizar(card.dataset.titulo + ' ' + card.dataset.cidade + ' ' + catCard);

                const bateCat   = categoriaAtiva === 'todos' || catCard === categoriaAtiva;
                const bateBusca = termo === '' || textoCard.includes(termo);
                const bateLocal = local === '' || cidadeCard === local;
                const bateMes   = mes === '' || dataCard.startsWith(mes);

                const mostrar = bateCat && bateBusca && bateLocal && bateMes;
                card.hidden = !mostrar;
                if (mostrar) visiveis++;
            });

            // Ordenação dos cards
            const ordenados = [...cardsTodos].sort((a, b) => {
                if (ordem === 'preco-menor') {
                    return parseFloat(a.dataset.preco || '0') - parseFloat(b.dataset.preco || '0');
                }
                if (ordem === 'preco-maior') {
                    return parseFloat(b.dataset.preco || '0') - parseFloat(a.dataset.preco || '0');
                }
                if (ordem === 'titulo') {
                    return (a.dataset.titulo || '').localeCompare(b.dataset.titulo || '', 'pt-BR');
                }
                // Mais recentes / próximos por data
                return (a.dataset.data || '').localeCompare(b.dataset.data || '');
            });

            ordenados.forEach((card) => gridTodos.appendChild(card));
            if (msgVazio) {
                msgVazio.hidden = visiveis > 0;
                gridTodos.appendChild(msgVazio);
            }
        }

        // Chips de categoria
        chipsCat.forEach((chip) => {
            chip.addEventListener('click', (e) => {
                e.preventDefault();
                categoriaAtiva = chip.dataset.filtroCat || 'todos';
                chipsCat.forEach((c) => c.classList.toggle('is-active', c === chip));
                aplicarFiltros();
            });
        });

        if (inputBusca) inputBusca.addEventListener('input', aplicarFiltros);
        if (selectLocal) selectLocal.addEventListener('change', aplicarFiltros);
        if (selectData) selectData.addEventListener('change', aplicarFiltros);
        if (selectOrdem) selectOrdem.addEventListener('change', aplicarFiltros);

        if (btnLimpar) {
            btnLimpar.addEventListener('click', () => {
                categoriaAtiva = 'todos';
                chipsCat.forEach((c) => c.classList.toggle('is-active', c.dataset.filtroCat === 'todos'));
                if (inputBusca) inputBusca.value = '';
                if (selectLocal) selectLocal.value = '';
                if (selectData) selectData.value = '';
                if (selectOrdem) selectOrdem.value = 'recentes';
                aplicarFiltros();
            });
        }

        if (btnVerTodos) {
            btnVerTodos.addEventListener('click', () => {
                const secaoTodos = document.getElementById('secao-todos-eventos');
                if (secaoTodos) secaoTodos.scrollIntoView({ behavior: 'smooth' });
            });
        }

        // Alternar visualização grade / lista
        viewBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const modo = btn.dataset.viewMode;
                viewBtns.forEach((b) => b.classList.toggle('is-active', b === btn));
                if (gridTodos) {
                    gridTodos.classList.toggle('is-list', modo === 'list');
                }
            });
        });

        // Setas do carrossel de destaques (rotaciona os cards de destaque)
        const gridDestaques = document.getElementById('grid-destaques');
        const btnPrev = document.querySelector('[data-destaque-prev]');
        const btnNext = document.querySelector('[data-destaque-next]');

        if (gridDestaques && btnPrev && btnNext) {
            btnNext.addEventListener('click', () => {
                const primeiro = gridDestaques.querySelector('.evento-card');
                if (primeiro) gridDestaques.appendChild(primeiro);
            });
            btnPrev.addEventListener('click', () => {
                const cards = gridDestaques.querySelectorAll('.evento-card');
                const ultimo = cards[cards.length - 1];
                if (ultimo) gridDestaques.prepend(ultimo);
            });
        }

        // Newsletter form
        if (formNews) {
            formNews.addEventListener('submit', (ev) => {
                ev.preventDefault();
                const inputEmail = formNews.querySelector('input[type="email"]');
                if (inputEmail && inputEmail.value.trim() !== '') {
                    if (window.EventCop && window.EventCop.toast) {
                        window.EventCop.toast('E-mail cadastrado com sucesso! Você receberá novidades em breve.', 'ok');
                    }
                    inputEmail.value = '';
                }
            });
        }

        aplicarFiltros();
    });
})();

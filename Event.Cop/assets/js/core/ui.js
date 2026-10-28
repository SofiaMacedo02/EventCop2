/**
 * EventCop - UI core. Sem dependências. Ativa comportamentos por atributos data-*:
 *   data-reveal            animação de entrada ao rolar (data-delay="ms")
 *   data-count="1234"      contador animado (data-prefix, data-suffix, data-decimals)
 *   [data-accordion]       acordeão (.accordion-trigger + .accordion-panel)
 *   [data-tabs]            abas ([role=tab][data-tab=x] + [data-panel=x])
 *   data-toast="mensagem"  mostra toast ao clicar
 *   data-menu-toggle       menu mobile do header público
 *   data-panel-toggle      sidebar mobile do painel do organizador
 * API global: window.EventCop.toast(msg, tipo)
 */
(function () {
    'use strict';

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------- Toast ---------- */
    function toast(mensagem, tipo) {
        const stack = document.querySelector('[data-toast-stack]');
        if (!stack) return;
        const el = document.createElement('div');
        el.className = 'toast' + (tipo === 'ok' ? ' is-ok' : '');
        el.textContent = mensagem;
        stack.appendChild(el);
        setTimeout(() => { el.classList.add('is-out'); setTimeout(() => el.remove(), 320); }, 3200);
    }
    window.EventCop = { toast };

    /* ---------- Contador ---------- */
    function animarContador(el) {
        const alvo = parseFloat(el.dataset.count);
        const casas = parseInt(el.dataset.decimals || '0', 10);
        const prefixo = el.dataset.prefix || '';
        const sufixo = el.dataset.suffix || '';
        const fmt = (n) => prefixo + n.toLocaleString('pt-BR', { minimumFractionDigits: casas, maximumFractionDigits: casas }) + sufixo;
        if (reduceMotion) { el.textContent = fmt(alvo); return; }
        const duracao = 1100;
        const inicio = performance.now();
        (function passo(agora) {
            const t = Math.min((agora - inicio) / duracao, 1);
            const ease = 1 - Math.pow(1 - t, 3);
            el.textContent = fmt(alvo * ease);
            if (t < 1) requestAnimationFrame(passo);
        })(inicio);
    }

    /* ---------- Reveal + contadores (IntersectionObserver) ---------- */
    function iniciarObservadores() {
        const alvos = document.querySelectorAll('[data-reveal], [data-count]');
        if (!('IntersectionObserver' in window)) {
            alvos.forEach((el) => { el.classList.add('is-visible'); if (el.dataset.count) animarContador(el); });
            return;
        }
        const io = new IntersectionObserver((entradas) => {
            entradas.forEach((entrada) => {
                if (!entrada.isIntersecting) return;
                const el = entrada.target;
                el.classList.add('is-visible');
                if (el.dataset.count !== undefined) animarContador(el);
                io.unobserve(el);
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
        alvos.forEach((el) => {
            if (el.dataset.delay) el.style.setProperty('--reveal-delay', el.dataset.delay + 'ms');
            io.observe(el);
        });
    }

    /* ---------- Acordeão ---------- */
    function iniciarAcordeoes() {
        document.querySelectorAll('[data-accordion]').forEach((item) => {
            const gatilho = item.querySelector('.accordion-trigger');
            const painel = item.querySelector('.accordion-panel');
            if (!gatilho || !painel) return;
            gatilho.addEventListener('click', () => {
                const aberto = item.classList.toggle('is-open');
                gatilho.setAttribute('aria-expanded', aberto ? 'true' : 'false');
                painel.style.maxHeight = aberto ? painel.scrollHeight + 'px' : '0px';
            });
        });
    }

    /* ---------- Abas ---------- */
    function iniciarAbas() {
        document.querySelectorAll('[data-tabs]').forEach((grupo) => {
            const abas = grupo.querySelectorAll('[role="tab"]');
            abas.forEach((aba) => {
                aba.addEventListener('click', () => {
                    abas.forEach((a) => { a.classList.toggle('is-active', a === aba); a.setAttribute('aria-selected', a === aba ? 'true' : 'false'); });
                    const destino = document.getElementById(aba.dataset.tab);
                    if (destino) destino.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' });
                });
            });
        });
    }

    /* ---------- Menus mobile ---------- */
    function iniciarMenus() {
        const botao = document.querySelector('[data-menu-toggle]');
        const menu = document.querySelector('[data-menu]');
        if (botao && menu) {
            botao.addEventListener('click', () => {
                const aberto = menu.classList.toggle('is-open');
                botao.setAttribute('aria-expanded', aberto ? 'true' : 'false');
            });
        }
        const painelBtn = document.querySelector('[data-panel-toggle]');
        const sidebar = document.querySelector('[data-panel-sidebar]');
        const fundo = document.querySelector('[data-panel-backdrop]');
        if (painelBtn && sidebar) {
            const alternar = (abrir) => {
                sidebar.classList.toggle('is-open', abrir);
                if (fundo) fundo.classList.toggle('is-open', abrir);
            };
            painelBtn.addEventListener('click', () => alternar(!sidebar.classList.contains('is-open')));
            if (fundo) fundo.addEventListener('click', () => alternar(false));
        }
    }

    /* ---------- Toast declarativo ---------- */
    function iniciarToasts() {
        document.addEventListener('click', (ev) => {
            const gatilho = ev.target.closest('[data-toast]');
            if (gatilho) { ev.preventDefault(); toast(gatilho.dataset.toast, gatilho.dataset.toastType); }
        });
    }

    /* ---------- Rolagem suave para âncoras internas ---------- */
    function iniciarAncoras() {
        document.addEventListener('click', (ev) => {
            const link = ev.target.closest('a[href^="#"]');
            if (!link || link.getAttribute('href') === '#') return;
            const alvo = document.querySelector(link.getAttribute('href'));
            if (alvo) { ev.preventDefault(); alvo.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' }); }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        iniciarObservadores();
        iniciarAcordeoes();
        iniciarAbas();
        iniciarMenus();
        iniciarToasts();
        iniciarAncoras();
    });
})();

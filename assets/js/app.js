// ============================================
// app.js — EstruturaNET
// ============================================

document.addEventListener('DOMContentLoaded', function () {

    // highlight.js — colore a sintaxe dos blocos de código
    if (typeof hljs !== 'undefined') {
        hljs.highlightAll();
    }

    // menu hamburguer no mobile
    const toggle = document.getElementById('menuToggle');
    const nav    = document.getElementById('navMenu');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            nav.classList.toggle('aberto');
        });
        // fecha o menu ao clicar fora
        document.addEventListener('click', function (e) {
            if (!toggle.contains(e.target) && !nav.contains(e.target)) {
                nav.classList.remove('aberto');
            }
        });
    }

    // botões de copiar código
    document.querySelectorAll('.btn-copiar').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const bloco  = btn.closest('.bloco-codigo');
            const codigo = bloco ? bloco.querySelector('code') : null;
            if (!codigo) return;

            navigator.clipboard.writeText(codigo.innerText).then(function () {
                const original = btn.textContent;
                btn.textContent = 'Copiado!';
                btn.style.background = 'var(--cor-verde)';
                btn.style.color = '#000';
                setTimeout(function () {
                    btn.textContent = original;
                    btn.style.background = '';
                    btn.style.color = '';
                }, 2000);
            }).catch(function () {
                btn.textContent = 'Erro ao copiar';
            });
        });
    });

    // sistema de tabs
    document.querySelectorAll('.tab-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const grupo = btn.closest('.tabs-container');
            if (!grupo) return;

            const alvo = btn.getAttribute('data-tab');

            grupo.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('ativo'));
            grupo.querySelectorAll('.tab-painel').forEach(p => p.classList.remove('ativo'));

            btn.classList.add('ativo');
            const painel = grupo.querySelector('[data-painel="' + alvo + '"]');
            if (painel) painel.classList.add('ativo');
        });
    });

    // sidebar: marca o link ativo conforme o scroll
    ativarSidebarScroll();

    // confirmação de exclusão no painel admin
    document.querySelectorAll('.btn-confirmar-excluir').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            if (!confirm('Tem certeza que quer excluir? Essa ação não pode ser desfeita.')) {
                e.preventDefault();
            }
        });
    });

});

// ============================================
// Sidebar: marca o link ativo pelo scroll
// ============================================
function ativarSidebarScroll() {
    const secoes = document.querySelectorAll('.secao[id]');
    const links  = document.querySelectorAll('.sidebar a[href^="#"]');
    if (secoes.length === 0 || links.length === 0) return;

    const observer = new IntersectionObserver(function (entradas) {
        entradas.forEach(function (entrada) {
            if (entrada.isIntersecting) {
                links.forEach(l => l.classList.remove('ativo'));
                const link = document.querySelector('.sidebar a[href="#' + entrada.target.id + '"]');
                if (link) link.classList.add('ativo');
            }
        });
    }, { rootMargin: '-20% 0px -60% 0px' });

    secoes.forEach(s => observer.observe(s));
}
(() => {
    const wardrobe = document.querySelector('[data-wardrobe]');
    if (wardrobe) {
        const character = wardrobe.querySelector('[data-character]');
        const original = {chapeu: character.dataset.chapeu, rosto: character.dataset.rosto, roupa: character.dataset.roupa};
        const cards = [...wardrobe.querySelectorAll('[data-item]')];
        const tabs = [...wardrobe.querySelectorAll('[data-filter]')];
        const search = wardrobe.querySelector('[data-item-search]');
        const owned = wardrobe.querySelector('[data-owned-filter]');
        const affordable = wardrobe.querySelector('[data-affordable-filter]');
        const status = wardrobe.querySelector('[data-preview-status]');
        const reset = wardrobe.querySelector('[data-reset-preview]');
        const normalize = value => value.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
        let category = 'all';
        function filter() {
            let count = 0;
            cards.forEach(card => {
                card.hidden = (category !== 'all' && card.dataset.category !== category)
                    || (owned.checked && card.dataset.owned !== 'true')
                    || (affordable?.checked && (card.dataset.affordable !== 'true' || card.dataset.owned === 'true'))
                    || !normalize(card.dataset.name).includes(normalize(search.value.trim()));
                if (!card.hidden) count++;
            });
            wardrobe.querySelector('[data-filter-count]').textContent = `${count} ${count === 1 ? 'item disponível' : 'itens disponíveis'}`;
            wardrobe.querySelector('[data-catalog-empty]').hidden = count !== 0;
        }
        tabs.forEach(tab => tab.addEventListener('click', () => {
            category = tab.dataset.filter;
            tabs.forEach(button => button.setAttribute('aria-pressed', String(button === tab)));
            filter();
        }));
        search.addEventListener('input', filter);
        owned.addEventListener('change', filter);
        affordable?.addEventListener('change', filter);
        wardrobe.querySelector('[data-clear-filters]').addEventListener('click', () => {
            search.value = ''; owned.checked = false; if (affordable) affordable.checked = false;
            tabs[0].click();
        });
        wardrobe.querySelectorAll('[data-preview-category]').forEach(button => {
            button.setAttribute('aria-pressed', 'false');
            button.addEventListener('click', () => {
                character.dataset[button.dataset.previewCategory] = button.dataset.previewVariant;
                wardrobe.querySelectorAll('[data-preview-category]').forEach(other => {
                    if (other.dataset.previewCategory === button.dataset.previewCategory) other.setAttribute('aria-pressed', String(other === button));
                });
                status.textContent = 'Prévia · não equipado'; status.classList.add('is-preview');
                character.querySelector('svg').setAttribute('aria-label', `Prévia do personagem com ${button.dataset.previewName}`);
                reset.hidden = false;
                if (window.matchMedia('(max-width:760px)').matches) {
                    character.scrollIntoView({block: 'center', behavior: window.matchMedia('(prefers-reduced-motion:reduce)').matches ? 'instant' : 'smooth'});
                }
            });
        });
        reset.addEventListener('click', () => {
            Object.assign(character.dataset, original); status.textContent = 'Visual equipado';status.classList.remove('is-preview');
            character.querySelector('svg').setAttribute('aria-label', 'Personagem com os itens equipados');
            wardrobe.querySelectorAll('[data-preview-category]').forEach(button => button.setAttribute('aria-pressed','false'));
            reset.hidden = true;
        });
        filter();
    }
    const answerForm = document.querySelector('[data-answer-form]');
    if (answerForm) {
        const submit = answerForm.querySelector('[data-answer-submit]');
        submit.disabled = !answerForm.querySelector('input[name="resposta"]:checked');
        answerForm.addEventListener('change', () => {
            const selected = answerForm.querySelector('input[name="resposta"]:checked');
            submit.disabled = !selected;
            answerForm.querySelector('[data-answer-status]').textContent = selected ? `Alternativa ${selected.value} selecionada.` : 'Selecione sua resposta para continuar.';
        });
        answerForm.addEventListener('submit', () => {submit.disabled = true; submit.textContent = 'Conferindo…';});
        window.addEventListener('pageshow', () => {submit.disabled = !answerForm.querySelector('input[name="resposta"]:checked');submit.textContent = 'Confirmar resposta →';});
    }
    document.querySelector('[data-errors-only]')?.addEventListener('change', event => {
        const reviews = [...document.querySelectorAll('[data-review]')];
        reviews.forEach(review => {review.hidden = event.target.checked && review.dataset.correct === 'true';});
        document.querySelector('[data-no-errors]').hidden = !(event.target.checked && reviews.every(review => review.dataset.correct === 'true'));
    });
})();

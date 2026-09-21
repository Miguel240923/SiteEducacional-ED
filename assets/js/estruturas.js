(() => {
    const laboratorio = document.querySelector('[data-estrutura]');
    if (!laboratorio) return;
    const tipo = laboratorio.dataset.estrutura;
    const valor = document.getElementById('valorEstrutura');
    const prioridade = document.getElementById('prioridadeEstrutura');
    const canvas = document.getElementById('vizEstrutura');
    const mensagem = document.getElementById('vizMensagem');
    let itens = [], ordem = 0;
    function render() {
        canvas.replaceChildren();
        if (!itens.length) { canvas.textContent = '∅ Estrutura vazia'; return; }
        itens.forEach((item, indice) => {
            const no = document.createElement('div'); no.className = 'no-visual';
            const dado = document.createElement('strong'); dado.textContent = item.valor;
            const legenda = document.createElement('small');
            legenda.textContent = (indice === 0 ? (tipo === 'pilha' ? 'topo · ' : 'início · ') : '') + (tipo === 'fila_prioridade' ? 'prioridade ' + item.prioridade : 'nó ' + (indice + 1));
            no.append(dado, legenda); canvas.append(no);
            const seta = document.createElement('span'); seta.className = 'seta'; seta.textContent = '→'; canvas.append(seta);
        });
        const fim = document.createElement('code'); fim.textContent = 'null'; canvas.append(fim);
    }
    document.getElementById('vizForm').addEventListener('submit', event => {
        event.preventDefault(); const texto = valor.value.trim(); if (!texto) return;
        if (itens.length >= 20) { mensagem.textContent = 'Limite visual de 20 nós. Remova um nó para continuar.'; return; }
        const item = { valor: texto, prioridade: prioridade ? Number(prioridade.value) : 0, ordem: ordem++ };
        if (tipo === 'pilha') itens.unshift(item);
        else { itens.push(item); if (tipo === 'fila_prioridade') itens.sort((a,b) => b.prioridade-a.prioridade || a.ordem-b.ordem); }
        mensagem.textContent = `Inserido: ${texto}. Total: ${itens.length} nó(s).`;
        valor.value = ''; valor.focus(); render();
    });
    document.getElementById('vizRemover').addEventListener('click', () => {
        if (!itens.length) { mensagem.textContent = 'Não é possível remover: estrutura vazia.'; return; }
        const removido = itens.shift(); mensagem.textContent = `Removido: ${removido.valor}. Total: ${itens.length} nó(s).`; render();
    });
    document.getElementById('vizLimpar').addEventListener('click', () => { itens = []; mensagem.textContent = 'Estrutura limpa.'; render(); });
    render();
})();

-- Execute uma vez em instalações existentes; seguro repetir.
INSERT INTO quiz_perguntas (pergunta,alternativa_a,alternativa_b,alternativa_c,alternativa_d,correta,explicacao,estrutura)
SELECT 'Um TAD especifica o quê?', 'Contrato de dados e operações, independente da implementação', 'Endereços físicos fixos', 'A interface gráfica da aplicação', 'Apenas a linguagem usada', 'A', 'Um TAD descreve os valores e as operações observáveis. Array e nós encadeados podem implementar o mesmo contrato.', 'tad'
WHERE NOT EXISTS (SELECT 1 FROM quiz_perguntas WHERE pergunta='Um TAD especifica o quê?');
INSERT INTO quiz_perguntas (pergunta,alternativa_a,alternativa_b,alternativa_c,alternativa_d,correta,explicacao,estrutura)
SELECT 'Na lista dupla A <-> B <-> C, quais ajustes removem o nó B?', 'A.Proximo = C; C.Anterior = A;', 'A.Anterior = C;', 'B.Proximo = A;', 'C.Proximo = B;', 'A', 'As referências dos dois vizinhos precisam pular B. Cabeça e cauda exigem tratamento especial se o nó removido for uma extremidade.', 'lista_dupla'
WHERE NOT EXISTS (SELECT 1 FROM quiz_perguntas WHERE pergunta='Na lista dupla A <-> B <-> C, quais ajustes removem o nó B?');
INSERT INTO quiz_perguntas (pergunta,alternativa_a,alternativa_b,alternativa_c,alternativa_d,correta,explicacao,estrutura)
SELECT 'Por que usar >= ao avançar sobre prioridades antes de inserir um novo nó?', 'Para inverter os empates', 'Para inserir após os nós de mesma prioridade e preservar FIFO', 'Para remover o último nó', 'Para impedir prioridades negativas', 'B', 'Avançar sobre nós de prioridade igual coloca o recém-chegado depois deles. Usar apenas > pode quebrar a estabilidade FIFO.', 'fila_prioridade'
WHERE NOT EXISTS (SELECT 1 FROM quiz_perguntas WHERE pergunta='Por que usar >= ao avançar sobre prioridades antes de inserir um novo nó?');
INSERT INTO quiz_perguntas (pergunta,alternativa_a,alternativa_b,alternativa_c,alternativa_d,correta,explicacao,estrutura)
SELECT 'Ao remover o único nó de uma fila com início e fim, qual estado é correto?', 'Somente início = null', 'Somente fim = null', 'início = null; fim = null;', 'fim aponta para início antigo', 'C', 'As duas referências devem representar a fila vazia. Manter fim apontando para um nó removido pode quebrar a próxima inserção.', 'fila_fifo'
WHERE NOT EXISTS (SELECT 1 FROM quiz_perguntas WHERE pergunta='Ao remover o único nó de uma fila com início e fim, qual estado é correto?');

# API REST – Situação Acadêmica

<img width="1278" height="794" alt="Captura de tela 2026-11-25 215534" src="https://github.com/user-attachments/assets/28d030c6-670b-4eef-af27-dc1abd0bf122" />
<img width="1279" height="794" alt="Captura de tela 2026-11-25 215556" src="https://github.com/user-attachments/assets/aad46bb2-c497-43fe-a88f-44bd0a4cbbba" />
<img width="1279" height="798" alt="Captura de tela 2026-11-25 215618" src="https://github.com/user-attachments/assets/ee94c0a7-a578-4c53-b5a3-762d41857bfe" />
<img width="1281" height="798" alt="Captura de tela 2026-11-25 215641" src="https://github.com/user-attachments/assets/1cdb204e-4bab-4e0a-ba3b-1f5073a8234d" />
<img width="1280" height="799" alt="Captura de tela 2026-11-25 215655" src="https://github.com/user-attachments/assets/369a314b-5e02-41ef-aa37-6a0d15757e65" />


## POST /situacao
Cadastra uma nova situação acadêmica.

**JSON de entrada:**
```json
{
    "nome": "Maria da Silva",
    "unidadeCurricular": "Desenvolvimento Web",
    "aprovado": true
}
```

## GET /situacao/{id}
Consulta a situação acadêmica de um estudante pelo ID.

**Exemplo:** `/situacao/1`

Retorna os dados do estudante em formato JSON.

## PUT /situacao/{id}
Atualiza exclusivamente o campo `aprovado`.

**JSON de entrada:**
```json
{
    "aprovado": false
}
```

## DELETE /situacao/{id}
Remove o registro acadêmico pelo ID.

**Resposta:**
```json
{
    "mensagem": "Registro removido com sucesso."
}
```

- Arthur Wiggers
- 2º Info

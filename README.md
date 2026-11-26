# API REST – Situação Acadêmica

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
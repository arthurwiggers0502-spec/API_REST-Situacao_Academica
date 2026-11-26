# API REST – Situação Acadêmica

<img width="800" height="497" alt="43b36ae4-0b26-45f6-8f23-546cd1413543" src="https://github.com/user-attachments/assets/5a64656c-fb82-4ade-bb19-c3dcb1afc4e0" />
<img width="800" height="497" alt="0e2da21b-4fed-4536-892e-9b66367e69e5" src="https://github.com/user-attachments/assets/9bc7d7c4-2f7e-45d5-a76c-051e8fce5f8c" />
<img width="800" height="499" alt="14dfd059-1028-4169-9e3b-a3ab5fddf0ed" src="https://github.com/user-attachments/assets/1d43d5e8-b2fe-4a07-bdfc-f361761a98a8" />
<img width="800" height="498" alt="cb375f03-6f67-494e-961c-874cd3157a72" src="https://github.com/user-attachments/assets/21be4fdd-3bea-4f64-8f4a-5c11bb094e14" />
<img width="800" height="499" alt="4d98c502-a75c-4f0c-bbfa-eb059439a47a" src="https://github.com/user-attachments/assets/1577055c-1605-4afd-a1bf-92b3b80482ab" />


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

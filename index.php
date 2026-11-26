
<?php

// Importa o Slim e suas bibliotecas
use Slim\Factory\AppFactory;
require __DIR__ . '/vendor/autoload.php';

// Inicializa a API e permite receber JSON
$app = AppFactory::create();
$app->addBodyParsingMiddleware();

// Define o arquivo que armazenará os registros
$arquivo = __DIR__ . '/dados.json';

// Cria o arquivo JSON caso ele não exista
if (!file_exists($arquivo)) file_put_contents($arquivo, '[]');

// Lê os dados do arquivo e transforma em array PHP
function lerDados($arquivo) {
    return json_decode(file_get_contents($arquivo), true) ?? [];
}

// Salva o array PHP no arquivo JSON
function salvarDados($arquivo, $dados) {
    file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

// POST - Cadastra uma situação acadêmica
$app->post('/situacao', function ($request, $response) use ($arquivo) {

    // Recebe e verifica os dados enviados
    $dados = $request->getParsedBody();

    if (!is_array($dados) || !isset($dados['nome'], $dados['unidadeCurricular'], $dados['aprovado']) || !is_string($dados['nome']) || !is_string($dados['unidadeCurricular']) || !is_bool($dados['aprovado'])) {
        $response->getBody()->write(json_encode(['erro' => 'Dados inválidos.']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    // Gera um ID e cria o registro
    $situacoes = lerDados($arquivo);
    $ids = array_column($situacoes, 'id');
    $id = empty($ids) ? 1 : max($ids) + 1;

    $novaSituacao = [
        'id' => $id,
        'nome' => $dados['nome'],
        'unidadeCurricular' => $dados['unidadeCurricular'],
        'aprovado' => $dados['aprovado']
    ];

    // Adiciona e salva o registro
    $situacoes[] = $novaSituacao;
    salvarDados($arquivo, $situacoes);

    $response->getBody()->write(json_encode($novaSituacao));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

// GET - Consulta uma situação pelo ID
$app->get('/situacao/{id}', function ($request, $response, $args) use ($arquivo) {

    // Procura o registro pelo ID
    $situacoes = lerDados($arquivo);
    $situacao = current(array_filter($situacoes, fn($s) => $s['id'] === (int) $args['id'])) ?: null;

    // Verifica se o registro existe
    if (!$situacao) {
        $response->getBody()->write(json_encode(['erro' => 'Situação acadêmica não encontrada.']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    }

    // Retorna o registro encontrado
    $response->getBody()->write(json_encode($situacao));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

// PUT - Atualiza somente o campo aprovado
$app->put('/situacao/{id}', function ($request, $response, $args) use ($arquivo) {

    // Recebe e verifica o novo valor
    $dados = $request->getParsedBody();

    if (!is_array($dados) || !isset($dados['aprovado']) || !is_bool($dados['aprovado'])) {
        $response->getBody()->write(json_encode(['erro' => 'Informe um valor booleano para aprovado.']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    // Procura o registro e atualiza a aprovação
    $situacoes = lerDados($arquivo);

    foreach ($situacoes as &$situacao) {
        if ($situacao['id'] === (int) $args['id']) {
            $situacao['aprovado'] = $dados['aprovado'];
            salvarDados($arquivo, $situacoes);

            $response->getBody()->write(json_encode($situacao));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
    }

    // Retorna erro se o ID não existir
    $response->getBody()->write(json_encode(['erro' => 'Situação acadêmica não encontrada.']));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
});

// DELETE - Remove uma situação acadêmica
$app->delete('/situacao/{id}', function ($request, $response, $args) use ($arquivo) {

    // Recupera os registros e verifica se o ID existe
    $situacoes = lerDados($arquivo);
    $existe = count(array_filter($situacoes, fn($s) => $s['id'] === (int) $args['id'])) > 0;

    if (!$existe) {
        $response->getBody()->write(json_encode(['erro' => 'Situação acadêmica não encontrada.']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    }

    // Remove o registro e salva o arquivo atualizado
    $situacoes = array_values(array_filter($situacoes, fn($s) => $s['id'] !== (int) $args['id']));
    salvarDados($arquivo, $situacoes);

    $response->getBody()->write(json_encode(['mensagem' => 'Registro removido com sucesso.']));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

// Inicia o servidor da API
$app->run();

<?php
require_once 'database/connection.php';
$conn = conecta_db();

$auditoria_id = $_GET['id'] ?? 0;

$query = "SELECT conforme FROM resposta_auditoria WHERE auditoria_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $auditoria_id);
$stmt->execute();
$result = $stmt->get_result();

$total_itens = 0;
$conformes = 0;

while ($linha = $result->fetch_object()) {
    $total_itens++;
    if ($linha->conforme === 'Sim') {
        $conformes++;
    }
}

$percentual_aderencia = $total_itens > 0 ? ($conformes / $total_itens) * 100 : 0;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Verificar Auditoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

    <h1>Auditoria #<?= $auditoria_id ?></h1>

    <h3>Aderência: <?= number_format($percentual_aderencia, 2) ?>%</h3>

    <form action="index.php?page=salvarAuditoria" method="POST">
        <input type="hidden" name="auditoria_id" value="<?= $auditoria_id ?>">

        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item</th>
                    <th>Conforme</th>
                    <th>Observação</th>
                    <th>Status NC</th>
                    <th>Responsável</th>
                    <th>Prazo</th>
                    <th>Data Resolução</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM resposta_auditoria WHERE auditoria_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $auditoria_id);
                $stmt->execute();
                $resultado = $stmt->get_result();

                if ($resultado->num_rows > 0) {
                    while ($linha = $resultado->fetch_object()) {
                        echo "<tr>";
                        echo "<td>{$linha->resposta_id}</td>";
                        echo "<td>{$linha->nome_item}</td>";

                        echo "<td>
                              <select name='conforme[{$linha->resposta_id}]' class='form-select'>
                                <option value='Sim' " . ($linha->conforme === 'Sim' ? 'selected' : '') . ">Sim</option>
                                <option value='Não' " . ($linha->conforme === 'Não' ? 'selected' : '') . ">Não</option>
                               </select>
                               </td>";

                        echo "<td><input type='text' name='observacao[{$linha->resposta_id}]' value='{$linha->observacao}' class='form-control'></td>";

                        echo "<td>
                              <select name='nc_status[{$linha->resposta_id}]' class='form-select'>
                                <option value='Aberta' " . ($linha->nc_status === 'Aberta' ? 'selected' : '') . ">Aberta</option>
                                <option value='Em Andamento' " . ($linha->nc_status === 'Em Andamento' ? 'selected' : '') . ">Em Andamento</option>
                                <option value='Resolvida' " . ($linha->nc_status === 'Resolvida' ? 'selected' : '') . ">Resolvida</option>
                              </select>
                              </td>";


                        echo "<td><input type='text' name='nc_responsavel[{$linha->resposta_id}]' value='{$linha->nc_responsavel}' class='form-control'></td>";

                        echo "<td><input type='date' name='nc_prazo[{$linha->resposta_id}]' value='{$linha->nc_prazo}' class='form-control'></td>";

                        echo "<td><input type='date' name='nc_data_resolucao[{$linha->resposta_id}]' value='{$linha->nc_data_resolucao}' class='form-control'></td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Nenhum item encontrado para esta auditoria.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary mt-3">Salvar Alterações</button>
        <a href="index.php?page=gerenciarAuditorias" class="btn btn-secondary mt-3">Voltar</a>
    </form>

</body>

</html>
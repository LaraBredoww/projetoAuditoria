<?php
require_once 'database/connection.php';
$conn = conecta_db();
include_once "verificarPrazos.php";

$query = "SELECT auditoria_id, data_auditoria, responsavel, observacao_geral, email_superior
          FROM auditoria 
          ORDER BY data_auditoria DESC";
$resultado = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Gerenciar Auditorias</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h1>Gerenciar Auditorias</h1>

<a href="index.php?page=cadAuditoria" class="btn btn-primary mb-3">Cadastrar Nova Auditoria</a>

<table class="table table-striped text-center">
  <thead>
    <tr>
      <th>ID</th>
      <th>Data</th>
      <th>Responsável</th>
      <th>Email do Superior</th>
      <th>Observação</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_object()) {
            echo "<tr>";
            echo "<td>{$linha->auditoria_id}</td>";
            echo "<td>{$linha->data_auditoria}</td>";
            echo "<td>{$linha->responsavel}</td>";
            echo "<td>{$linha->email_superior}</td>";
            echo "<td>{$linha->observacao_geral}</td>";
            echo "<td>
                    <a href='index.php?page=verificarAuditoria&id={$linha->auditoria_id}' class='btn btn-sm btn-success'>Ver/Editar</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Nenhuma auditoria cadastrada.</td></tr>";
    }
    ?>
  </tbody>
</table>

</body>
</html>

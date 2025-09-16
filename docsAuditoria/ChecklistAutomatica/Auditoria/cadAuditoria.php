<?php
require_once 'database/connection.php';
$conn = conecta_db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data_auditoria = $_POST['data_auditoria'];
    $responsavel = $_POST['responsavel'];
    $observacao_geral = $_POST['observacao_geral'];
    $email_superior = $_POST['email_superior'];

    $query = "INSERT INTO auditoria (data_auditoria, responsavel, observacao_geral, email_superior) 
              VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $data_auditoria, $responsavel, $observacao_geral, $email_superior);
    $stmt->execute();

    header("Location: gerenciarAuditorias.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Auditoria</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h1>Cadastrar Nova Auditoria</h1>

<form method="POST">
  <div class="mb-3">
    <label for="data_auditoria" class="form-label">Data da Auditoria</label>
    <input type="date" name="data_auditoria" id="data_auditoria" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="responsavel" class="form-label">Responsável</label>
    <input type="text" name="responsavel" id="responsavel" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="email_superior" class="form-label">Email do Superior</label>
    <input type="email" name="email_superior" id="email_superior" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="observacao_geral" class="form-label">Observação Geral</label>
    <textarea name="observacao_geral" id="observacao_geral" class="form-control"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Salvar</button>
  <a href="index.php?page=gerenciarAuditorias" class="btn btn-secondary">Voltar</a>
</form>

</body>
</html>

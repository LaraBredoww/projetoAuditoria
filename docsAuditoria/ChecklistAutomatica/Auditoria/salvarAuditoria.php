<?php
require_once 'database/connection.php';
$conn = conecta_db();

$auditoria_id = $_POST['auditoria_id'] ?? 0;

foreach ($_POST['conforme'] as $resposta_id => $valor) {
    $conforme = $_POST['conforme'][$resposta_id];
    $observacao = $_POST['observacao'][$resposta_id];
    $nc_status = $_POST['nc_status'][$resposta_id];
    $nc_responsavel = $_POST['nc_responsavel'][$resposta_id];
    $nc_prazo = $_POST['nc_prazo'][$resposta_id];
    $nc_data_resolucao = $_POST['nc_data_resolucao'][$resposta_id];

    $query = "UPDATE resposta_auditoria 
              SET conforme=?, observacao=?, nc_status=?, nc_responsavel=?, nc_prazo=?, nc_data_resolucao=?
              WHERE resposta_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $conforme, $observacao, $nc_status, $nc_responsavel, $nc_prazo, $nc_data_resolucao, $resposta_id);
    $stmt->execute();
}

header("Location: index.php?page=verificarAuditoria&id=" . $auditoria_id);
exit;

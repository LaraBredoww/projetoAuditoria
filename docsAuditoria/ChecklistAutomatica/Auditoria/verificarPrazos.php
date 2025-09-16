<?php
require_once __DIR__ . '/database/connection.php';
$conn = conecta_db();

$query = "
    SELECT 
        a.auditoria_id,
        a.email_superior,
        r.resposta_id,
        r.nome_item,
        r.observacao,
        r.nc_prazo,
        r.nc_status,
        r.conforme,
        r.email_enviado
    FROM auditoria a
    INNER JOIN resposta_auditoria r 
        ON r.auditoria_id = a.auditoria_id
";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $hoje = date('Y-m-d');
    $encontrouNC = false;

    while ($linha = $result->fetch_object()) {

        if ($linha->email_enviado !== 'Sim' 
            && $linha->conforme === 'Não' 
            && !empty($linha->nc_prazo) 
            && $linha->nc_prazo < $hoje 
            && $linha->nc_status != 'Resolvida') {

            $encontrouNC = true;

            $para = $linha->email_superior;
            $assunto = "Não-Conformidade Vencida - Auditoria #{$linha->auditoria_id}";
            
            $corpo = "Prezado(a),\n\n".
                     "A auditoria #{$linha->auditoria_id} possui uma não-conformidade que ultrapassou o prazo de resolução.\n\n".
                     "Item: {$linha->nome_item}\n".
                     "Observação: {$linha->observacao}\n".
                     "Prazo original: {$linha->nc_prazo}\n".
                     "Status atual: {$linha->nc_status}\n\n".
                     "Por favor, tome as providências necessárias.\n\n".
                     "Atenciosamente,\nSistema de Auditoria";

            $headers = "From: opentijucas@gmail.com\r\n" .
                       "Reply-To: opentijucas@gmail.com\r\n" .
                       "X-Mailer: PHP/" . phpversion();

            if (mail($para, $assunto, $corpo, $headers)) {
                echo "Email enviado para $para sobre a auditoria #{$linha->auditoria_id}<br>";

                $update = $conn->prepare("UPDATE resposta_auditoria SET email_enviado = 'Sim' WHERE resposta_id = ?");
                $update->bind_param("i", $linha->resposta_id);
                $update->execute();
            } else {
                echo "Falha ao enviar email para $para<br>";
            }
        }
    }

    if (!$encontrouNC) {
        echo "Nenhuma não-conformidade vencida encontrada.";
    }

} else {
    echo "Nenhuma resposta encontrada no banco.";
}
?>

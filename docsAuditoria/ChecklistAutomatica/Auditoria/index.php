<!--Index que leva o usuário para a página de acordo com seu clique-->

<?php

if (isset($_GET['page'])) {
  if ($_GET['page'] == 'gerenciarAuditorias') {
    include 'gerenciarAuditorias.php';
  } else if ($_GET['page'] == 'verificarAuditoria') {
    include 'verificarAuditoria.php';
  } else if ($_GET['page'] == 'cadAuditoria') {
    include 'cadAuditoria.php';
  } else if ($_GET['page'] == 'salvarAuditoria') {
    include 'salvarAuditoria.php';
  }
} else {
  include 'gerenciarAuditorias.php';
}



?>
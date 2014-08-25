<?php
require_once("init.php");
include("layout/_header.php");

$delete = CRUD::delete("contact_list", array("id" => $_GET['id']));
?>
<h3>Excluir</h3>
<hr>
<?php
if ($delete):
  ?>
  <div class="alert alert-success" role="alert">Dados excluídos com sucesso</div>
<?php else: ?>
  <div class="alert alert-danger" role="alert">Erro ao tentar excluir os dados</div>
<?php
endif;
?>
<?php include("layout/_footer.php"); ?>
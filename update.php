<?php
require_once("init.php");
include("layout/_header.php");

$table = "contact_list";

if (!isset($_POST['submit'])) {
  if ($contact = CRUD::select($table, array("id" => $_GET['id']))) {
    $contact = get_object_vars($contact[0]);
    foreach ($contact as $key => $value) {
      $$key = $value;
    }
  }
} else {
  foreach ($_POST as $key => $value) {
    $$key = $value;
  }
  $update = CRUD::update($table, array("name" => $name, "email" => $email, "phone" => $phone), array("id" => $id));
}
?>
<h3>Editar</h3>
<hr>
<form role="form" method="POST" name="updateForm">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="form-group">
    <label for="name">Nome</label>
    <input type="text" name="name" required class="form-control" id="name" placeholder="" value="<?= $name ?>">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" required class="form-control" id="email" placeholder="" value="<?= $email ?>">
  </div>
  <div class="form-group">
    <label for="phone">Telefone</label>
    <input type="text" name="phone" required class="form-control" id="phone" placeholder="" value="<?= $phone ?>">
  </div>
  <button type="submit" name="submit" class="btn btn-default">Alterar</button>
</form><br>
<?php
if (isset($_POST['submit'])):
  if ($update):
    ?>
    <div class="alert alert-success" role="alert">Dados alterados com sucesso</div>
  <?php else: ?>
    <div class="alert alert-danger" role="alert">Erro ao tentar alterar os dados</div>
  <?php
  endif;
endif;
?>
<?php include("layout/_footer.php"); ?>
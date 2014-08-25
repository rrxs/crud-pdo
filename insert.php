<?php
require_once("init.php");
include("layout/_header.php");

if (isset($_POST['submit'])) {
  foreach ($_POST as $key => $value) {
    $$key = $value;
  }
  $insert = CRUD::insert("contact_list", array(
              "name" => $name,
              "email" => $email,
              "phone" => $phone
  ));
}
?>
<h3>Inserir</h3>
<hr>
<form role="form" method="POST">
  <div class="form-group">
    <label for="name">Nome</label>
    <input type="text" name="name" required class="form-control" id="name" placeholder="">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" required class="form-control" id="email" placeholder="">
  </div>
  <div class="form-group">
    <label for="phone">Telefone</label>
    <input type="text" name="phone" required class="form-control" id="phone" placeholder="">
  </div>
  <button type="submit" name="submit" class="btn btn-default">Inserir</button>
</form><br>
<?php
if (isset($_POST['submit'])):
  if ($insert):
    ?>
    <div class="alert alert-success" role="alert">Dados inseridos com sucesso</div>
  <?php else: ?>
    <div class="alert alert-danger" role="alert">Erro ao tentar inserir os dados</div>
  <?php
  endif;
endif;
?>
<?php include("layout/_footer.php"); ?>
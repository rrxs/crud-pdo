<?php
require_once("init.php");
include("layout/_header.php");
?>
<h3>Contatos</h3>
<hr>
<?php
$contacts = CRUD::find_all("contact_list");
if ($contacts):
  ?>
  <table class="table table-striped table-hover">
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Telefone</th>
      <th>Opções</th>
    </tr>
    <?php
    foreach ($contacts as $k => $ob):
      ?>
      <tr>
        <td><?= $ob->id ?></td>
        <td><?= $ob->name ?></td>
        <td><?= $ob->email ?></td>
        <td><?= $ob->phone ?></td>
        <td>
          <a href="update.php?id=<?= $ob->id ?>"><span style="color:#ec971f" class="glyphicon glyphicon-edit"></span></a> | 
          <a style="cursor:pointer" 
             onclick="if (confirm('Excluir?'))
                   window.location.href = 'delete.php?id=<?= $ob->id ?>'">
            <span style="color:#c9302c" class="glyphicon glyphicon-remove-circle"></span>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php else: ?>
  <h4>Nenhum contato cadastrado</h4>
<?php endif; ?>
<br>
<a href="insert.php"><button class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Inserir</button></a>
<?php include("layout/_footer.php"); ?>
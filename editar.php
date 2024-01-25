<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$usuario = false;

$id = filter_input(INPUT_GET, 'id');//id é enviado via get através do link editar
if($id) {
    $usuario = $usuarioDao->findById($id);//busca o usuario do banco pelo id recebido via get
}

if($usuario === false) {
    header("Location: index.php");
    exit;
}
?>
<h1>Editar Usuário</h1>

<form method="POST" action="editar_action.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$usuario->getId();?>" />
 
    <label>
        Nome:<br/>
        <input type="text" name="name" value="<?=$usuario->getNome();?>" />
    </label><br/><br/>

    <label>
        E-mail:<br/>
        <input type="email" name="email" value="<?=$usuario->getEmail();?>" />
    </label><br/><br/>
    <div class="form-group">
    <label for="foto">foto</label>
    <input type="file" class="form-control" id="arquivo" name="fotos">
  </div>
    <div>
        fotos
       <img src="assets/images/fotos/<?=$usuario->getFoto(); ?>">
    </div>

    <input type="submit" value="Salvar" />
</form>
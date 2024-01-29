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

<hmtl>
    <head>
        <title>LOJA CASA DOS LIVROS</title>
        
                
		<link rel="stylesheet" type="text/css" href="http://localhost/crud/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="http://localhost/crud/assets/css/style.css" />
        <link rel="stylesheet" type="text/css" href="http://localhost/crud/assets/css/login.css" />
        <script type="text/javascript" src="http://localhost/crud/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://localhost/crud/assets/js/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
            
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="./" class="navbar-brand">Classificados Brasil</a>
                </div>

                
            </div>
              
 </nav>
<div class="container-fluid">


    <form method="POST" action="adicionar_action.php" enctype="multipart/form-data">

  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $usuario->getNome();?>">
  </div>
  <div class="form-group">
    <label for="email">email</label>
    <input type="text" class="form-control" id="email" name="email" value="<?php echo $usuario->getEmail();?>">
  </div>
   <div class="form-group">
    <label for="foto">foto</label>
    <input type="file" class="form-control" id="arquivo" name="fotos">
  </div>
  <input type="submit" value="cadastrar" class="btn btn-primary"/>
</form>
    <figure class="figure">
  <img src="assets/images/fotos/<?=$usuario->getFoto(); ?>" class="figure-img img-fluid rounded" alt="Imagem de um quadrado genérico com bordas arredondadas, em uma figure.">
  <figcaption class="figure-caption">Foto de <b><i><?php echo $usuario->getNome(); ?></i></b></figcaption>
</figure>
</div>
</body>
</html>
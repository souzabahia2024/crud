
<hmtl>
    <head>
        <title>ola mundo</title>
        
                
       <link rel="stylesheet" type="text/css" href="http://localhost/crud/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="http://localhost/crud/assets/css/style.css" />
        <script type="text/javascript" src="http://localhost/crud/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://localhost/crud/assets/js/jquery.min.js"></script>
</head>
<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);





$qt_por_pagina=5;
$total=0;

$total=$usuarioDao->contar();
$paginas=$total/$qt_por_pagina;
$pg=1;
if(isset($_GET['p']) && !empty($_GET['p'])){
//$pg=addslaches($_GET[p]);
    $pg=filter_input(INPUT_GET, 'p');
}
$p=($pg-1)*$qt_por_pagina;
$lista=$usuarioDao->paginar($p,$qt_por_pagina);






?>
<body>
<nav class="navbar navbar-inverse">
            
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="./" class="navbar-brand">Classificados Brasil</a>
                </div>


            </div>
              
        </nav>
<div class="container-fluid">



    <form method="post" action="filtro_pdf.php">
        <div class="box-search form-group">
        <input type="text" name="nome" placeholder="pesquisar" class="form-control"/>
        <button class="btn btn-primary">
            
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>
        </button>
      </div>
</form>

    <a href="adicionar.php" class="btn btn-primary">NOVO</a>
<a href="filtro_pdf.php" class="btn btn-primary">IMPRIMIR</a>

<table border="1" width="100%" class="table table-striped">
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>EMAIL</th>
        <th>FOTO</th>
        <th>AÇÕES</th>
    </tr>
    <?php foreach($lista as $usuario): ?>
        <tr>
            <td><?=$usuario->getId();?></td>
            <td><?=$usuario->getNome();?></td>
            <td><?=$usuario->getEmail();?></td>
            <td><img src="assets/images/fotos/<?=$usuario->getFoto(); ?>" width="75" height="65"/></td>
            <td>
                <a href="editar.php?id=<?=$usuario->getId();?>" class="btn btn-success">Editar </a>
                <a href="excluir.php?id=<?=$usuario->getId();?>" onclick="return confirm('Tem certeza que deseja excluir?')" class="btn btn-danger"> Excluir </a>
            </td>
        </tr>
    <?php endforeach; ?>
         
</table>
<?php
     for($q=0;$q<$paginas;$q++){
 
   echo '<a href="./filtro.php?p='.($q+1).'">['.($q+1).']</a>      '; 
     }
 ?>

    </div>
   
    </body>
</html>
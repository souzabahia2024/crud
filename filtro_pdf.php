
<hmtl>
    <head>
        <title>usuarios</title>
        
                
       <link rel="stylesheet" type="text/css" href="http://localhost/crud/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="http://localhost/crud/assets/css/style.css" />
        <script type="text/javascript" src="http://localhost/crud/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://localhost/crud/assets/js/jquery.min.js"></script>
</head>
<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);





$qt_por_pagina=3;
$total=0;


$paginas=$total/$qt_por_pagina;
$pg=1;
$nome= filter_input(INPUT_POST,'nome');
if(isset($_GET['p']) && !empty($_GET['p'])){
//$pg=addslaches($_GET[p]);
    $pg=filter_input(INPUT_GET, 'p');
    
    
}
$total=$usuarioDao->contarFiltro($nome);
$p=($pg-1)*$qt_por_pagina;
$lista=$usuarioDao->paginarFiltro($p,$qt_por_pagina,$nome);






?>
<body>
    <h3>Relatorio de usuarios</h3>
<nav class="navbar navbar-inverse">
            
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="./" class="navbar-brand">Classificados Brasil</a>
                </div>


            </div>
              
        </nav>
<div class="container-fluid">
<a href="filtro.php" class="btn btn-primary">VOLTAR</a>
<a href="adicionar.php" class="btn btn-primary">NOVO</a>
<a href="relatoriofiltrado.php?nome=<?=$nome;?>" class="btn btn-primary">IMPRIMIR</a>

<table border="1" width="100%" class="table table-striped">
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>EMAIL</th>
        <th>FOTO</th>
        
    </tr>
    <?php foreach($lista as $usuario): ?>
        <tr>
            <td><?=$usuario->getId();?></td>
            <td><?=$usuario->getNome();?></td>
            <td><?=$usuario->getEmail();?></td>
            <td><img src="assets/images/fotos/<?=$usuario->getFoto(); ?>" width="75" height="65"/></td>
            
        </tr>
    <?php endforeach; ?>
</table>
<?php
     for($q=0;$q<$paginas;$q++){
      echo '<a href="./filtro_pdf.php?p='.($q+1).'">['.($q+1).']</a>      '; 
     }
 ?>
    </div>
    
    </body>
</html>

<hmtl>
    <head>
        <title> LOJA CASA DOS LIVROS</title>
        
                
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
    <h1>LOJA DE LIVROS</h1>

<nav class="navbar navbar-inverse">
            
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="./" class="navbar-brand">LIVRO-NOSSO MELHOR AMIGO</a>
                </div>


            </div>
              
        </nav>
<div class="container-fluid">
<a href="adicionar.php" class="btn btn-primary">NOVO</a>
<a href="index_pdf.php" class="btn btn-primary">IMPRIMIR</a>
<a href="filtro.php" class="btn btn-primary">PESQUISAR</a>
<a href="fotogd.php" class="btn btn-primary">GALERIA DE FOFOS</a>


<table border="1" width="100%" class="table  table-dark">
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
            <td><img src="assets/images/fotos/<?=$usuario->getFoto(); ?>"></td>
            <td>
                <a href="editar.php?id=<?=$usuario->getId();?>" class="btn btn-success">Editar </a>
                <a href="excluir.php?id=<?=$usuario->getId();?>" onclick="return confirm('Tem certeza que deseja excluir?')" class="btn btn-danger"> Excluir </a>
            </td>
        </tr>
    <?php endforeach; ?>
         
</table>
<?php
     for($q=0;$q<$paginas;$q++){
 
   echo '<a href="./?p='.($q+1).'">['.($q+1).']</a>      '; 
     }
 ?>
    </div>
   <p>Obrigado volte sempre</p>
    </body>
</html>

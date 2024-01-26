<?php
ob_start();
?>
<hmtl>
    <head>
        <title>LOJA CASA DOS LIVROS</title>
        
                
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
<nav class="navbar navbar-inverse">
            
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="./" class="navbar-brand">Classificados Brasil</a>
                </div>


            </div>
              
        </nav>
<div class="container-fluid">
<h3>RELATORIO DE USUARIOS</h3>


<table border="1" width="100%" class="table table-dark">
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
    </div>
    <?php

/*
 * composer require mpdf/mpdf pra baixar mpdf pelo composer
 * 
 * require_once __DIR__ . '/vendor/autoload.php'; //pra carregar a classe Mpdf 
    $mpdf = new \Mpdf\Mpdf();//pra instanciar o objeto  mpdf no projeto
 */
    $html= ob_get_contents();
    ob_end_clean();
    require_once __DIR__ . '/vendor/autoload.php';
     $mpdf = new \Mpdf\Mpdf();
     $mpdf->WriteHTML($html);
     $mpdf->Output();

?>
    </body>
</html>
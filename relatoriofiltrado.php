<?php
ob_start();
?>
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
///$nome = filter_input(INPUT_POST, 'nome');
$nome = filter_input(INPUT_GET, 'nome');
$lista=$usuarioDao->findByName($nome);
////var_dump($lista);
//foreach ($lista as $user){
   // var_dump($lista);
    //echo "nome do cliente" .$user['nome'];
//}
  echo "SouzaWeb Web Sistemas";
?>
<body>
    <h3>Relatorio de Usuários</h3>
<nav class="navbar navbar-inverse">
            
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="./" class="navbar-brand">Classificados Brasil</a>
                </div>


            </div>
              
        </nav>
<div class="container-fluid">


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
            <td><img src="assets/images/fotos/<?=$usuario->getFoto(); ?>" width="65" height="65"/></td>
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
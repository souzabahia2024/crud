<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$name = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

$permitdos=array('image/jpeg','image/jpg','image/png');
if(in_array($_FILES['fotos']['type'], $permitdos)){
    
    $pastadafotos='assets/images/fotos';
    $tmpname=$usuarioDao->manipulaFotos($pastadafotos);
   
        $novoUsuario = new Usuario();
    
        $novoUsuario->setNome($name);
        $novoUsuario->setEmail($email);
        $novoUsuario->setFoto($tmpname);
         $usuarioDao->add($novoUsuario);
         header("Location: index.php");
         exit;
    
}
else{
    echo "arquivo invalido";
}










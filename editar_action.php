



<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);






    $id = filter_input(INPUT_POST, 'id');
    $nome = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);  
    $pastadefotos='assets/images/fotos';
    $nomedafoto=$usuarioDao->manipulaFotos($pastadefotos);
       /* echo "<h2>Dados recebidos</h2>";
        echo "ID :".$id."<br/>";
        echo "NOME :".$nome."<br/>";
        echo "EMAIL :".$email."<br/>";
        echo "FOTO :".$nomedafoto."<br/>";
        * 
        */
    $usuario=new Usuario();
    $usuario->setNome($nome);
    $usuario->setEmail($email);
    $usuario->setFoto($nomedafoto);
    $usuario->setId($id);
    $usuarioDao->update($usuario);
    //echo "CADASTRO ATUALIZADO COM SUCESSO";
    
    header("Location: index.php");
    exit;

   


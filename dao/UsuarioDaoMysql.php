<?php
require_once 'models/Usuario.php';

class UsuarioDaoMysql implements UsuarioDAO {
    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function add(Usuario $u) {
        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email,foto) VALUES (:nome, :email,:foto)");
        $sql->bindValue(':nome', $u->getNome());
        $sql->bindValue(':email', $u->getEmail());
        $sql->bindValue(':foto', $u->getFoto());
        $sql->execute();

        $u->setId( $this->pdo->lastInsertId() );
        return $u;
    }

    public function findAll() {
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM usuarios");
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

            foreach($data as $item) {
                $u = new Usuario();
                $u->setId($item['id']);
                $u->setNome($item['nome']);
                $u->setEmail($item['email']);
                $u->setFoto($item['foto']);

                $array[] = $u;
            }
        }

        return $array;
    }
      
    public function contar(){
        $total=0;
        $sql = "SELECT * FROM usuarios";
$sql = $this->pdo->query($sql);
$total = $sql->rowCount();

        return $total ;

    }
    
    
    public function contarFiltro($nome){
       $filtrado="%$nome%";
         $array = [];
         $total=0;
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE nome like :nome");
        $sql->bindParam(':nome',$filtrado, PDO::PARAM_STR);
        $sql->execute();
       $total=$sql->rowCount();

        
            
        return $total;

    }
    
    
    
    public function paginar($p,$qt_por_pagina){
        $array = [];
        $sql="select * from usuarios LIMIT $p,$qt_por_pagina";
$sql=$this->pdo->query($sql);
if($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

            foreach($data as $item) {
                $u = new Usuario();
                $u->setId($item['id']);
                $u->setNome($item['nome']);
                $u->setEmail($item['email']);
                $u->setFoto($item['foto']);
                $array[] = $u;
            }
        }

        return $array;
    }
    
    
    
    public function paginarFiltro($p,$qt_por_pagina,$nome){
       $filtrado="%$nome%";
         $array = [];
        $u = new Usuario();
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE nome like :nome LIMIT $p,$qt_por_pagina");
        $sql->bindParam(':nome',$filtrado, PDO::PARAM_STR);
        $sql->execute();
        $data = $sql->fetchAll();
         foreach($data as $item) {
               
                $u->setId($item['id']);
                $u->setNome($item['nome']);
                $u->setEmail($item['email']);
                $u->setFoto($item['foto']);
                $array[] = $u;
            }
       return $array;
           
    }
    public function findAllPaginable($inicio,$limite) {
        $array = [];
           
        $sql = $this->pdo->query("SELECT * FROM usuarios");
       
            $data = $sql->fetchAll();

            foreach($data as $item) {
                $u = new Usuario();
                $u->setId($item['id']);
                $u->setNome($item['nome']);
                $u->setEmail($item['email']);

                $array[] = $u;
            }
        echo $inicio;

        return $array;
    }

    
    
    
    public function findByName($nome) {
        $filtrado="%$nome%";
         $array = [];
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE nome like :nome");
        $sql->bindParam(':nome',$filtrado, PDO::PARAM_STR);
        $sql->execute();
       $data = $sql->fetchAll();
         foreach($data as $item) {
                $u = new Usuario();
                $u->setId($item['id']);
                $u->setNome($item['nome']);
                $u->setEmail($item['email']);
                $u->setFoto($item['foto']);
                $array[] = $u;
            }
        return $array;
    }

    
    
    
    public function findByEmail($email) {
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $u = new Usuario();
            $u->setId($data['id']);
            $u->setNome($data['nome']);
            $u->setEmail($data['email']);
            $u->setFoto($item['foto']);
            return $u;
        } else {
            return false;
        }
    }
    public function findById($id) {
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $u = new Usuario();
            $u->setId($data['id']);
            $u->setNome($data['nome']);
            $u->setEmail($data['email']);
            $u->setFoto($data['foto']);
            return $u;
        } else {
            return false;
        }
    }

    public function update(Usuario $u) {
        $sql = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email,foto=:foto WHERE id = :id");
        $sql->bindValue(':nome', $u->getNome());
        $sql->bindValue(':email', $u->getEmail());
        $sql->bindValue(':foto', $u->getFoto());
        $sql->bindValue(':id', $u->getId());
        $sql->execute();

        return true;
    }

    public function delete($id) {
        $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
    
     public function paginarFiltro2($p,$qt_por_pagina,$nome){
       $filtrado="%$nome%";
         $i=new Usuario();
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE nome like :nome LIMIT $p,$qt_por_pagina");
        $sql->bindParam(':nome',$filtrado, PDO::PARAM_STR);
        $sql->execute();
        $u = $sql->fetchAll();
         
       return $u;
           
    }
    public  function manipulaFotos($pastaFoto){
         $tmpname = md5(time().rand(0,9999)).'.jpg';
        // $pastaFoto='assets/images/fotos';
					move_uploaded_file($_FILES['fotos']['tmp_name'], $pastaFoto.'/'.$tmpname);
					list($width_orig, $height_orig) = getimagesize($pastaFoto.'/'.$tmpname);
					$ratio = $width_orig/$height_orig;
					$width = 80;
					$height =80 ;
					if($width/$height > $ratio) {
						$width = $height*$ratio;
					} else {
						$height = $width/$ratio;
					}

					$img = imagecreatetruecolor($width, $height);
                                        $origi = imagecreatefromjpeg($pastaFoto.'/'.$tmpname);
					

					imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

					imagejpeg($img, $pastaFoto.'/'.$tmpname, 80);

         return $tmpname;
    }
    public function linha(){
         echo "<br/>";
    }
    
    
    public function editarUsuarioComFoto($nome, $email, $foto, $id) {
		

		$sql = $this->db->prepare("UPDATE usuarios SET nome = :nome, email = :email,foto = :foto WHERE id = :id");
		$sql->bindValue(":nome", $nome);
		$sql->bindValue(":email", $email);
		//$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
		$sql->bindValue(":foto", $foto);
		
		$sql->bindValue(":id", $id);
		$sql->execute();


    header("Location: index.php");
    exit;
    }
    
public function linha(){
    echo "<br/>";
}
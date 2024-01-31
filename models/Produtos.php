<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Produtos
 *
 * @author souza
 */
class Produtos {
   private $id;
    private $descricao;
    private $preco;
    private $foto;

    public function getId() {
        return $this->id;
    }
    public function setId($i) {
        $this->id = trim($i);
    }

    public function getDescricao() {
        return $this->descricao;
    }
    public function setDescricao($desc) {
        $this->descricao = ucwords(trim($desc));
    }

    public function getPreco() {
        return $this->preco;
    }
    public function setPreco($preco) {
        $this->email = $this->preco;
    }
    
    public function getFoto(){
        return $this->foto;
    }
    public  function setFoto($foto){
        $this->foto=$foto;
    }
}

interface ProdutoDAO {
    public function add(Produto $prod);
    public function findAll();
    public function findByDescricao($descricao);
    public function findById($id);
    public function update(Produto $prod);
    public function delete($id);

}

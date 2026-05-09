<?php

require_once 'Database.php';

class FilmesLista{
    private $db;

  
   public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function listarfilmes() {
       
        $query = "SELECT id, nome, genero, imagem, duracao, diretor  FROM filmes";
        
        // Prepara e executa a busca
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
       
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}









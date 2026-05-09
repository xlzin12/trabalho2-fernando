<?php
require_once 'Database.php';

class Excluir {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    
    public function deletar_registro($id) {
        
        $query = "DELETE FROM filmes WHERE id = :id";        
        
        $stmt = $this->db->prepare($query);
        
      
        $stmt->execute(['id' => $id]);
        
    header("Location: ../index.php");
        exit;
    }
}



if (isset($_GET['id'])) {
  
    $id_selecionado = $_GET['id'];
    
   
    $acao = new Excluir();
    
   
    $acao->deletar_registro($id_selecionado);
} else {
    
    header("Location: ../index.php");
    exit;
}
?>
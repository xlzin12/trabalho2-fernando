<?php
require_once 'Database.php';

class Editar {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function buscarFilme($id) {
        $query = "SELECT * FROM filmes WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarFilme($id, $nome, $genero, $diretor, $duracao) {
        $query = "UPDATE filmes SET nome = :nome, genero = :genero, diretor = :diretor, duracao = :duracao WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'nome' => $nome,
            'genero' => $genero,
            'diretor' => $diretor,
            'duracao' => $duracao,
            'id' => $id
        ]);
    }
}
?>
<?php

require_once 'Database.php';

class Filmes {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // O parâmetro $arquivo_imagem agora vai receber o $_FILES['imagem']
    public function adicionarFilme($nome, $genero, $diretor, $arquivo_imagem, $duracao) {
        
        // 1. LÓGICA PARA SALVAR A IMAGEM NA PASTA
        $pasta_destino = "uploads/";
        
        // Cria a pasta se ela não existir
        if (!is_dir($pasta_destino)) {
            mkdir($pasta_destino, 0777, true);
        }

        // Pega as informações do arquivo enviado
        $nome_arquivo = $arquivo_imagem['name'];
        $caminho_temporario = $arquivo_imagem['tmp_name'];
        
        // Descobre a extensão e cria um nome único para não substituir imagens com mesmo nome
        $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
        $novo_nome_imagem = uniqid() . "." . $extensao;
        $caminho_final = $pasta_destino . $novo_nome_imagem;

        // 2. TENTA MOVER A IMAGEM PARA A PASTA 'UPLOADS'
        if (move_uploaded_file($caminho_temporario, $caminho_final)) {
            
            // 3. SE A IMAGEM FOI SALVA COM SUCESSO, INSERE NO BANCO DE DADOS
            $sql = "INSERT INTO filmes (nome, genero, diretor, imagem, duracao) VALUES (:nome, :genero, :diretor, :imagem, :duracao)";
            $stmt = $this->db->prepare($sql);
            
            // Repare que aqui passamos a variável $caminho_final para o banco
            $stmt->execute([
                'nome' => $nome,
                'genero' => $genero,
                'diretor' => $diretor,
                'duracao' => $duracao,
                'imagem' => $caminho_final 
            ]);

            return true; // Retorna verdadeiro indicando que deu tudo certo

        } else {
            // Se falhar o upload da imagem, encerra com erro
            throw new Exception("Erro ao salvar a imagem na pasta do servidor.");
        }
    }

    public function listarFilmes() {
        $sql = "SELECT * FROM filmes";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
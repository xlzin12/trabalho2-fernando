CREATE DATABASE netflix;

USE netflix;

CREATE TABLE filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    diretor VARCHAR(100) NOT NULL,
    genero VARCHAR(100) NOT NULL,
    duracao TIME NOT NULL,
    data_lancamento DATE NOT NULL,
    imagem VARCHAR(255) NOT NULL
);



g
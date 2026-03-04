<?php

namespace Core;

use PDO;
use PDOException;
use App\Models\User;

class Database
{
    private PDO $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=localhost;dbname=nutritech", "root", "");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTables();

            User::setConnection($this->connection);

        } catch (PDOException $e) {
            die("Erro de conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    public function createTables(): void
    {
        // Cria tabela users
        $this->connection->exec("
            CREATE TABLE IF NOT EXISTS users (
                user_id INT AUTO_INCREMENT PRIMARY KEY,
                user_name VARCHAR(255) NOT NULL,
                user_email VARCHAR(255) NOT NULL UNIQUE,
                user_password VARCHAR(255) NOT NULL,
                user_foto VARCHAR(255),
                user_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ");

        // Cria tabela categoria
        $this->connection->exec(
            "
            CREATE TABLE IF NOT EXISTS category (
                category_id INT AUTO_INCREMENT PRIMARY KEY,
                category_nome VARCHAR(255) NOT NULL,
                category_description TEXT NOT NULL
            );
            "
        );

        // Cria tabela combinacao
        $this->connection->exec(
            "
            CREATE TABLE IF NOT EXISTS combinacao (
                combinacao_id INT AUTO_INCREMENT PRIMARY KEY,
                combinacao_description TEXT NOT NULL,
                category_beneficio TEXT NOT NULL
            );
            "
        );

        // Cria tabela receitas
        $this->connection->exec("
            CREATE TABLE IF NOT EXISTS recipes (
                recipe_id INT AUTO_INCREMENT PRIMARY KEY,
                recipe_nome VARCHAR(255) NOT NULL,
                recipe_ingredientes TEXT NOT NULL,
                recipe_modo_reparo TEXT NOT NULL,
                recipe_tempo_reparo INT NOT NULL,
                recipe_unidades VARCHAR(50) NOT NULL,
                recipe_porcoes INT NOT NULL,
                recipe_regras TEXT NULL,
                recipe_restricao_alimentar VARCHAR(150) NULL,
                recipe_dificuldade VARCHAR(50) NOT NULL,
                recipe_feedback TEXT NULL,
                category_id INT NOT NULL,
                combinacao_id INT NULL,
                recipe_imagem VARCHAR(255) NULL,
                recipe_video VARCHAR(255) NULL,
                recipe_criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                CONSTRAINT fk_recipe_category
                    FOREIGN KEY (category_id) 
                    REFERENCES category(category_id)
                    ON DELETE CASCADE
                    ON UPDATE CASCADE,

                CONSTRAINT fk_recipe_combinacao
                    FOREIGN KEY (combinacao_id)
                    REFERENCES combinacao(combinacao_id)
                    ON DELETE SET NULL
                    ON UPDATE CASCADE

            ) ENGINE=InnoDB 
            DEFAULT CHARSET=utf8mb4 
            COLLATE=utf8mb4_unicode_ci;
        ");

    }
}

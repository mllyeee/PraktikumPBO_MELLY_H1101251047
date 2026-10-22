<?php

class DatabaseConnection
{
    private static ?self $instance = null;
    private PDO $connection;

    private function __construct()
    {
        $host = 'localhost';
        $database = 'latihan_pdo';
        $username = 'root';
        $password = '';

        $this->connection = new PDO(
            "mysql:host=$host;dbname=$database;charset=utf8mb4",
            $username,
            $password
        );

        $this->connection->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        $this->connection->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC
        );
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    private function __clone() {}
}
<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $dbPath = dirname(__DIR__, 2) . '/database/simpli.db';
            $this->pdo = new PDO("sqlite:$dbPath");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ATTR_ERRMODE_EXCEPTION);
            $this->pdo->exec("PRAGMA foreign_keys = ON");  // Aktifkan foreign key
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
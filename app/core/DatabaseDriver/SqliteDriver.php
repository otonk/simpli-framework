<?php

use PDO; // Import PDO class
use PDOException;

class SqliteDriver {
    protected ?PDO $pdo = null; // Gunakan nullable type

    /**
     * Membuat koneksi PDO ke database SQLite.
     *
     * @param array $config Konfigurasi koneksi ('path').
     * @return PDO Instance PDO.
     * @throws PDOException Jika koneksi gagal.
     */
    public function connect(array $config): PDO {
        if (!isset($config['path'])) {
             throw new InvalidArgumentException("SQLite configuration missing 'path'.");
        }

        $dsn = "sqlite:" . $config['path'];

        try {
            $this->pdo = new PDO($dsn);
            // Set atribut setelah koneksi berhasil
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Penting untuk error handling
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Fetch default
            $this->pdo->exec("PRAGMA foreign_keys = ON;"); // Aktifkan foreign key constraint
            return $this->pdo;
        } catch (PDOException $e) {
            // Re-throw exception untuk ditangani oleh Database class atau App
            throw new PDOException("SQLite Connection Error: " . $e->getMessage(), (int)$e->getCode(), $e);
        }
    }
}

?>
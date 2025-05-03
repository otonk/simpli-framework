<?php

use PDO; // Import PDO class
use PDOException;

class MysqlDriver {
    protected ?PDO $pdo = null;

    /**
     * Membuat koneksi PDO ke database MySQL.
     *
     * @param array $config Konfigurasi koneksi ('host', 'port', 'database', 'username', 'password', 'charset', 'collation', 'options').
     * @return PDO Instance PDO.
     * @throws PDOException Jika koneksi gagal.
     * @throws InvalidArgumentException Jika konfigurasi kurang.
     */
    public function connect(array $config): PDO {
        // Validasi konfigurasi dasar
        $requiredKeys = ['host', 'database', 'username', 'password'];
        foreach ($requiredKeys as $key) {
            if (!isset($config[$key])) {
                throw new InvalidArgumentException("MySQL configuration missing '{$key}'.");
            }
        }

        // Set default jika tidak ada
        $host = $config['host'];
        $port = $config['port'] ?? '3306';
        $dbname = $config['database'];
        $charset = $config['charset'] ?? 'utf8mb4';
        $username = $config['username'];
        $password = $config['password'];

        // Buat Data Source Name (DSN)
        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";

        // Opsi PDO default (bisa ditimpa dari config)
        $defaultOptions = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false, // Gunakan native prepared statements
            PDO::ATTR_STRINGIFY_FETCHES  => false,
        ];

        // Gabungkan opsi default dengan opsi dari file konfigurasi
        $options = array_replace($defaultOptions, $config['options'] ?? []);

        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
            return $this->pdo;
        } catch (PDOException $e) {
            // Re-throw exception
            throw new PDOException("MySQL Connection Error: " . $e->getMessage(), (int)$e->getCode(), $e);
        }
    }
}

?>
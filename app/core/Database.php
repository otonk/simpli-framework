<?php

use PDO; // Import PDO class

class Database {
    private static $instance = null; // Gunakan null sebagai initial value
    private $pdo;
    private static $config = null;

    // Buat constructor private untuk mencegah instansiasi langsung
    private function __construct() {
        // Muat konfigurasi hanya sekali
        if (self::$config === null) {
             self::$config = require BASE_PATH . '/config/database.php';
        }

        $config = self::$config;
        $defaultDriver = $config['default']; // Contoh: 'sqlite' atau 'mysql'

        if (!isset($config['connections'][$defaultDriver])) {
             throw new Exception("Database configuration for '{$defaultDriver}' not found.");
        }

        $connectionConfig = $config['connections'][$defaultDriver];
        $driverType = $connectionConfig['driver']; // 'sqlite' atau 'mysql'

        // Tentukan nama class driver
        $driverClass = match($driverType) {
            'sqlite' => 'SqliteDriver',
            'mysql' => 'MysqlDriver',
            default => throw new Exception("Database driver '{$driverType}' not supported.")
        };

        // Cek apakah class driver ada (autoloader harus menemukannya)
        if (!class_exists($driverClass)) {
            throw new Exception("Database driver class '{$driverClass}' not found. Check autoloader and file location.");
        }

        try {
            // Buat instance driver dan koneksikan
            $driverInstance = new $driverClass();
            $this->pdo = $driverInstance->connect($connectionConfig);

            // Set error mode ke Exception (jika belum di driver)
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException $e) {
            // Tangkap error koneksi PDO
             throw new Exception("Database Connection Error: " . $e->getMessage(), (int)$e->getCode(), $e);
        } catch (\Throwable $e) {
             // Tangkap error lain saat instansiasi driver
             throw new Exception("Database Driver Error ({$driverClass}): " . $e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * Mendapatkan instance Singleton dari koneksi PDO.
     * @return PDO Instance PDO yang aktif.
     */
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            // Gunakan try-catch di sini juga untuk error saat __construct
            try {
                 self::$instance = new self();
            } catch (\Throwable $e) {
                 // Handle error kritis saat membuat koneksi pertama kali
                 // Bisa log error atau re-throw
                 // Untuk simple framework, bisa tampilkan error jika DEBUG_MODE on
                 if (defined('DEBUG_MODE') && DEBUG_MODE === true) {
                     echo "<h1>Database Initialization Failed</h1>";
                     echo "<pre>" . $e->getMessage() . "\n" . $e->getTraceAsString() . "</pre>";
                 } else {
                     echo "<h1>Database Error</h1><p>Could not connect to the database.</p>";
                 }
                 exit;
            }
        }
        return self::$instance->pdo;
    }

    // Cegah cloning instance (Singleton pattern)
    private function __clone() {}

    // Cegah unserialization instance (Singleton pattern)
    public function __wakeup() {
        throw new Exception("Cannot unserialize a singleton.");
    }
}
?>
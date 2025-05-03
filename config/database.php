<?php

// Fungsi helper untuk membaca variabel environment dari file .env
if (!function_exists('env')) {
    function env($key, $default = null) {
        static $dotenv = null;
        if ($dotenv === null) {
            $envPath = BASE_PATH . '/.env'; // Gunakan BASE_PATH dari config.php
            if (file_exists($envPath)) {
                // Parse sederhana, hindari komentar dan baris kosong
                $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $dotenv = [];
                foreach ($lines as $line) {
                    if (strpos(trim($line), '#') === 0) {
                        continue; // Lewati komentar
                    }
                    if (strpos($line, '=') !== false) {
                        list($name, $value) = explode('=', $line, 2);
                        $name = trim($name);
                        $value = trim($value);
                        // Hapus quote jika ada (opsional)
                        if (strlen($value) > 1 && $value[0] == '"' && $value[strlen($value) - 1] == '"') {
                           $value = substr($value, 1, -1);
                        }
                         if (strlen($value) > 1 && $value[0] == "'" && $value[strlen($value) - 1] == "'") {
                           $value = substr($value, 1, -1);
                        }
                        $dotenv[$name] = $value;
                    }
                }
            } else {
                $dotenv = false; // Tandai bahwa .env tidak ada/gagal dibaca
            }
        }
        // Jika .env tidak ada atau key tidak ditemukan, return default
        if ($dotenv === false || !array_key_exists($key, $dotenv)) {
            return $default;
        }
        return $dotenv[$key];
    }
}

// Konfigurasi koneksi database
return [
    // Driver default: 'sqlite' atau 'mysql'
    'default' => env('DB_CONNECTION', 'sqlite'),

    // Daftar koneksi database
    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            // Pastikan path ini benar relatif terhadap root project
            'path'   => BASE_PATH . '/database/' . env('DB_DATABASE', 'simpli.db'),
        ],

        'mysql' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', '127.0.0.1'),
            'port'      => env('DB_PORT', '3306'),
            'database'  => env('DB_DATABASE', 'simpli'),
            'username'  => env('DB_USERNAME', 'root'),
            'password'  => env('DB_PASSWORD', ''),
            'charset'   => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'options'   => [
                 // Opsi PDO tambahan jika diperlukan
                 PDO::ATTR_EMULATE_PREPARES   => false, // Gunakan native prepared statements
                 PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exception saat error
                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Default fetch mode
                 PDO::ATTR_STRINGIFY_FETCHES  => false,
            ],
        ]
    ]
];
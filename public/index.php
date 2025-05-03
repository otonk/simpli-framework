<?php

// Mulai session jika diperlukan (opsional, tambahkan jika butuh session)
// session_start();

// Definisikan Konstanta Path Dasar
define('BASE_PATH', dirname(__DIR__)); // Path ke folder 'simpli'

// Muat file konfigurasi utama
// Pastikan config.php sudah mendefinisikan BASEURL, DEBUG_MODE, DEFAULT_CONTROLLER, DEFAULT_METHOD
require_once BASE_PATH . '/config/config.php';

// Muat helper functions
require_once BASE_PATH . '/app/helpers.php';

/**
 * Autoloader Sederhana
 * Memuat class dari folder app/core, app/controllers, app/models, dan app/core/DatabaseDriver
 */
spl_autoload_register(function($className) {
    // Ganti backslash namespace (jika nanti digunakan) dengan DIRECTORY_SEPARATOR
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    // Daftar path prioritas untuk autoload
    $paths = [
        BASE_PATH . '/app/core/',
        BASE_PATH . '/app/controllers/',
        BASE_PATH . '/app/models/',
        BASE_PATH . '/app/core/DatabaseDriver/' // Path driver DB
    ];

    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return; // Hentikan pencarian jika file ditemukan
        }
    }
    // Jika class tidak ditemukan, biarkan PHP menangani error "Class not found"
});


// Inisialisasi Aplikasi
try {
    $app = new App(); // Buat instance App (constructornya sekarang kosong/minimal)
    $app->run();     // Jalankan logika routing utama di method run()
} catch (\Throwable $e) { // Tangkap Throwable untuk error PHP 7+ dan Exception
    // Penanganan error fatal jika App gagal diinisialisasi atau autoloader gagal total
    http_response_code(500); // Set kode status error server
    if (defined('DEBUG_MODE') && DEBUG_MODE === true) {
        // Tampilkan detail error jika mode debug aktif
        echo "<h1>Fatal Error</h1>";
        echo "<pre>";
        echo "Message: " . htmlspecialchars($e->getMessage()) . "\n";
        echo "File: " . htmlspecialchars($e->getFile()) . "\n";
        echo "Line: " . htmlspecialchars($e->getLine()) . "\n";
        echo "Trace: \n" . htmlspecialchars($e->getTraceAsString());
        echo "</pre>";
    } else {
        // Pesan error generic untuk production
        echo "<h1>500 Internal Server Error</h1>";
        echo "Terjadi kesalahan pada server. Silakan coba lagi nanti.";
    }
    exit;
}

?>

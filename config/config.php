<?php

/**
 * Konfigurasi Aplikasi Utama Simpli Framework
 */

// --- URL Dasar Aplikasi (Dinamis) ---
// Menentukan protokol (http atau https)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

// Mendapatkan nama host (domain atau IP)
$host = $_SERVER['HTTP_HOST'] ?? 'localhost'; // Fallback ke localhost jika HTTP_HOST tidak ada (misal CLI)

// Mendapatkan path script utama (index.php di folder public)
// SCRIPT_NAME biasanya: /simpli/public/index.php
// dirname() akan menghasilkan: /simpli/public
$scriptPath = dirname($_SERVER['SCRIPT_NAME'] ?? '');

// Menghapus slash di akhir jika ada, dan memastikan tidak ada double slash
$baseUri = rtrim($scriptPath, '/');

// Gabungkan semuanya menjadi BASEURL
// Contoh hasil: http://localhost/simpli/public atau https://namadomain.com/folderproyek/public
define('BASEURL', $protocol . $host . $baseUri);


// --- Mode Debug ---
// Set ke 'false' di production untuk menyembunyikan detail error
define('DEBUG_MODE', true); // Ganti jadi false saat di produksi


// --- Default Controller dan Method ---
// Digunakan jika URL kosong atau hanya BASEURL
define('DEFAULT_CONTROLLER', 'Home');
define('DEFAULT_METHOD', 'index');


// --- Konfigurasi Lain (jika ada) ---
// Contoh:
// define('APP_NAME', 'Aplikasi Simpli Saya');
// define('SESSION_DURATION', 3600); // Durasi session dalam detik (1 jam)

?>

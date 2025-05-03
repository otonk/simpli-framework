<?php

/**
 * Menghasilkan URL lengkap ke file aset di folder public.
 *
 * @param string $path Path relatif ke aset dari folder /public/assets/.
 * @return string URL lengkap ke aset.
 */
function asset($path) {
    // Hapus slash di awal jika ada
    $path = ltrim($path, '/');
    // Gabungkan BASEURL dengan path aset
    $url = rtrim(BASEURL, '/') . '/assets/' . $path;
    // Escape URL untuk keamanan (meskipun biasanya tidak perlu untuk path aset internal)
    return htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
}

/**
 * Melakukan redirect ke URL internal (relatif terhadap BASEURL).
 *
 * @param string $url Path tujuan (e.g., 'users/profile', '/posts').
 */
function redirect($url) {
    // Hapus slash di awal jika ada, tambahkan satu jika perlu
    $location = rtrim(BASEURL, '/') . '/' . ltrim($url, '/');
    header("Location: " . $location);
    exit; // Pastikan script berhenti setelah redirect
}

/**
 * Helper untuk mendapatkan instance PDO Database (opsional).
 * Memudahkan akses DB tanpa 'use' namespace jika tidak pakai namespace.
 * @return PDO
 */
function db() {
    return Database::getInstance();
}

/**
 * Helper untuk escape output HTML.
 *
 * @param string|null $string String yang akan di-escape.
 * @return string String yang sudah di-escape.
 */
function e(?string $string): string {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

?>
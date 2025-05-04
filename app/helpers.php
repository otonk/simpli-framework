<?php

/**
 * Menghasilkan URL lengkap ke file aset di folder public.
 *
 * @param string $path Path relatif ke aset dari folder /public/assets/.
 * @return string URL lengkap ke aset.
 */
function asset($path) {
    $path = ltrim($path, '/');
    $url = rtrim(BASEURL, '/') . '/assets/' . $path;
    return htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
}

/**
 * Melakukan redirect ke URL internal (relatif terhadap BASEURL).
 *
 * @param string $url Path tujuan (e.g., 'users/profile', '/posts').
 */
function redirect($url) {
    $location = rtrim(BASEURL, '/') . '/' . ltrim($url, '/');
    header("Location: " . $location);
    exit;
}

/**
 * Helper untuk mendapatkan instance PDO Database (opsional).
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

/**
 * Menghasilkan tag <script> untuk inisialisasi DataTables pada elemen tertentu.
 *
 * @param string $tableSelector CSS Selector untuk tabel (e.g., '#myTable', '.datatable-class').
 * @param array $options Array opsi DataTables dalam format PHP (akan di-encode ke JSON).
 * @return string Tag <script> lengkap.
 */
function initDataTables(string $tableSelector, array $options = []): string {
    // Encode opsi PHP ke JSON, pastikan angka tidak jadi string
    $jsonOptions = json_encode($options, JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);

    // Gunakan HEREDOC untuk script yang lebih rapi
    $script = <<<HTML
<script>
    // Pastikan jQuery dan DataTables sudah dimuat sebelum script ini dijalankan
    // $(document).ready() memastikan DOM siap
    $(document).ready(function() {
        // Cek jika elemen tabel ada sebelum inisialisasi
        if ($('$tableSelector').length) {
            try {
                $('$tableSelector').DataTable($jsonOptions);
            } catch (e) {
                console.error("Error initializing DataTables for selector '$tableSelector':", e);
            }
        } else {
             console.warn("DataTables warning: Element with selector '$tableSelector' not found.");
        }
    });
</script>
HTML;
    return $script; // Return string script
}

?>

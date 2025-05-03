<?php

class ErrorController extends Controller {

    /**
     * Menampilkan halaman 404 Not Found.
     *
     * @param string $message Pesan error spesifik (opsional).
     */
    public function notFound($message = 'Halaman yang Anda cari tidak ditemukan.') {
        http_response_code(404);
        $data = [
            'title' => '404 Not Found',
            'message' => $message, // Tampilkan pesan error dari App.php
            'show_logo' => true
        ];
        // Gunakan layout 'error'
        $this->view('errors/404', $data, 'error');
    }

    /**
     * Menampilkan halaman 500 Internal Server Error.
     *
     * @param \Throwable|null $error Exception atau Error yang terjadi.
     */
    public function serverError(\Throwable $error = null) {
        http_response_code(500);
        $data = [
            'title' => '500 Server Error',
            'message' => 'Terjadi kesalahan internal pada server.',
            // Kirim objek error hanya jika DEBUG_MODE aktif
            'error' => (defined('DEBUG_MODE') && DEBUG_MODE === true) ? $error : null,
            'show_logo' => false // Tidak tampilkan logo di error 500
        ];
         // Gunakan layout 'error'
        $this->view('errors/500', $data, 'error');
    }
}

?>
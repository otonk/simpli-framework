<?php
class ErrorController extends Controller {
    public function notFound() {
        http_response_code(404);
        $this->view('errors/404', [
            'title' => '404 Not Found',
            'message' => '404 - Halaman tidak ditemukan',
            'show_logo' => true
        ]);
    }

    public function serverError($error = null) {
        http_response_code(500);
        $this->view('errors/500', [
            'title' => '500 Server Error',
            'message' => '500 - Terjadi kesalahan pada server',
            'error' => (defined('DEBUG_MODE') && DEBUG_MODE) ? $error : null,
            'show_logo' => false
        ]);
    }
}
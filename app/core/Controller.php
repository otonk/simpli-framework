<?php

/**
 * Base Controller
 * Semua controller lain harus extends class ini.
 */
abstract class Controller {

    /**
     * Memuat dan menampilkan view dengan layout.
     *
     * @param string $view   Nama file view (tanpa .php) relatif dari folder app/views. Contoh: 'home/index'.
     * @param array  $data   Data yang ingin dikirim ke view.
     * @param string $layout Nama file layout (tanpa .php) di folder app/views/layouts. Default: 'main'.
     * @throws Exception Jika file view atau layout tidak ditemukan.
     */
    protected function view($view, $data = [], $layout = 'main') {
        // Path ke file view content
        $viewPath = BASE_PATH . '/app/views/' . str_replace('.', '/', $view) . '.php';
        if (!file_exists($viewPath)) {
            throw new Exception("View file not found: {$viewPath}");
        }

        // Path ke file layout
        $layoutPath = BASE_PATH . '/app/views/layouts/' . $layout . '.php';
        if (!file_exists($layoutPath)) {
            throw new Exception("Layout file not found: {$layoutPath}");
        }

        // Variabel $data dan $viewPath sekarang akan tersedia di dalam scope layout
        // karena require_once dipanggil dari sini.

        // Render layout (layout akan me-require $viewPath di dalamnya)
        require_once $layoutPath;
    }

    /**
     * Memuat dan mengembalikan instance model.
     *
     * @param string $model Nama model (tanpa 'Model'). Contoh: 'User' untuk 'UserModel'.
     * @return object Instance dari model.
     * @throws Exception Jika class model tidak ditemukan.
     */
    protected function model($model) {
        $modelClass = ucfirst($model) . 'Model';
        // $modelPath = BASE_PATH . '/app/models/' . $modelClass . '.php'; // Tidak perlu path jika autoloader benar

        if (!class_exists($modelClass)) {
             throw new Exception("Model class not found: " . $modelClass);
        }

        // Autoloader seharusnya sudah memuat file model
        return new $modelClass();
    }

     /**
      * Helper untuk redirect dari dalam controller.
      *
      * @param string $url Path tujuan (e.g., 'users/profile', '/posts').
      */
     protected function redirect($url) {
         // Gunakan helper function global
         redirect($url);
     }
}

?>
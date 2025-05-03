<?php

/**
 * Class Aplikasi Utama (Router)
 * Bertanggung jawab untuk memparsing URL dan memanggil Controller/Method yang sesuai.
 */
class App {
    // Properti untuk menyimpan nama controller, method, parameter, dan instance controller
    protected string $controllerName = DEFAULT_CONTROLLER; // Default dari config.php
    protected string $methodName = DEFAULT_METHOD;       // Default dari config.php
    protected array $params = [];
    protected ?Controller $controllerInstance = null; // Instance Controller yang aktif

    /**
     * Constructor - Sebaiknya dibuat minimal atau kosong.
     * Logika utama dipindah ke run().
     */
    public function __construct() {
        // Kosongkan constructor atau isi dengan inisialisasi minimal jika perlu
    }

    /**
     * Method utama untuk menjalankan aplikasi (dipanggil dari index.php).
     */
    public function run(): void {
        try {
            $url = $this->parseURL();

            $this->resolveController($url);
            $this->resolveMethod($url);
            $this->resolveParams($url);

            $this->execute();
        } catch (\Throwable $e) { // Tangkap Exception dan Error
            $this->handleError($e);
        }
    }

    /**
     * Memparsing URL dari query string 'url'.
     * @return array Bagian-bagian URL.
     */
    protected function parseURL(): array {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            if ($url === false) {
                throw new Exception("Invalid URL format", 400);
            }
            return ($url === '') ? [] : explode('/', $url);
        }
        return [];
    }

    /**
     * Mencari dan menyiapkan controller berdasarkan URL.
     * @param array $url Referensi ke array URL yang sudah diparsing.
     */
    protected function resolveController(array &$url): void {
        $potentialControllerName = $this->controllerName; // Gunakan default dulu

        if (!empty($url[0])) {
            $urlControllerName = ucfirst(strtolower($url[0]));
            $controllerFile = BASE_PATH . "/app/controllers/{$urlControllerName}Controller.php";

            if (file_exists($controllerFile)) {
                $potentialControllerName = $urlControllerName; // Gunakan dari URL jika ada
                unset($url[0]);
            } else {
                $errorMessage = "Page not found (Controller file not found for '{$urlControllerName}')";
                throw new Exception($errorMessage, 404);
            }
        }

        $this->controllerName = $potentialControllerName;
        $controllerClass = $this->controllerName . 'Controller';

        if (!class_exists($controllerClass)) {
             $errorMessage = "Controller class '{$controllerClass}' not found or could not be loaded.";
            throw new Exception($errorMessage, 500);
        }

        $this->controllerInstance = new $controllerClass();

        if (!$this->controllerInstance instanceof Controller) {
             $errorMessage = "Class '{$controllerClass}' must extend the base Controller class.";
             throw new Exception($errorMessage, 500);
        }
    }

    /**
     * Mencari dan menyiapkan method berdasarkan URL.
     * @param array $url Referensi ke array URL.
     */
    protected function resolveMethod(array &$url): void {
        $potentialMethodName = $this->methodName; // Gunakan default dulu

        if (isset($url[1])) {
            $urlMethodName = strtolower($url[1]); // Ambil method dari URL

            if (method_exists($this->controllerInstance, $urlMethodName)) {
                $potentialMethodName = $urlMethodName; // Gunakan dari URL jika ada
                unset($url[1]);
            } else {
                // Method tidak ditemukan
                $controllerClassName = $this->controllerName . 'Controller'; // Ambil nama class (string)
                $errorMessage = "Action not found. Method: '" . $urlMethodName . "' in Controller: '" . $controllerClassName . "'";
                throw new Exception($errorMessage, 404); // Baris ini (atau sekitar sini) kemungkinan sumber error sebelumnya
            }
        }

        $this->methodName = $potentialMethodName;

         if (!method_exists($this->controllerInstance, $this->methodName)) {
              $controllerClassName = $this->controllerName . 'Controller'; // Ambil nama class (string)
              $errorMessage = "Method not found. Method: '" . $this->methodName . "' in Controller: '" . $controllerClassName . "'";
              throw new Exception($errorMessage, 500);
         }
    }

    /**
     * Menyiapkan parameter dari sisa URL.
     * @param array $url Referensi ke array URL.
     */
    protected function resolveParams(array &$url): void {
        $this->params = $url ? array_values($url) : [];
    }

    /**
     * Menjalankan controller method dengan parameter.
     */
    protected function execute(): void {
        call_user_func_array(
            [$this->controllerInstance, $this->methodName],
            $this->params
        );
    }

    /**
     * Menangani error yang terjadi selama routing atau eksekusi.
     * @param \Throwable $e Exception atau Error yang ditangkap.
     */
    protected function handleError(\Throwable $e): void {
        $statusCode = ($e->getCode() >= 400 && $e->getCode() < 600) ? $e->getCode() : 500;

        if (!class_exists('ErrorController')) {
            http_response_code($statusCode);
            echo "<h1>Error</h1><p>Critical Error: ErrorController class not found.</p>";
            if (defined('DEBUG_MODE') && DEBUG_MODE === true) {
                echo "<pre>" . htmlspecialchars($e->getMessage()) . "\n" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
            }
            exit;
        }

        try {
            $errorController = new ErrorController();
            $message = $e->getMessage(); // Ambil pesan error (string)

            if ($statusCode === 404) {
                $errorController->notFound($message);
            } else {
                $errorController->serverError($e);
            }
        } catch (\Throwable $fatalError) {
             http_response_code(500);
             echo "<h1>Fatal Error</h1><p>ErrorController failed to handle the error.</p>";
             if (defined('DEBUG_MODE') && DEBUG_MODE === true) {
                 echo "<h2>Original Error:</h2><pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
                 echo "<h2>Handling Error:</h2><pre>" . htmlspecialchars($fatalError->getMessage()) . "\n" . htmlspecialchars($fatalError->getTraceAsString()) . "</pre>";
             }
        }
        exit;
    }
}
?>
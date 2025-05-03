<?php
class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];
    
    public function __construct() {
        try {
            $this->registerAutoloader();
            $url = $this->parseURL();
            
            $this->resolveController($url);
            $this->resolveMethod($url);
            $this->resolveParams($url);
            
            $this->execute();
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }
    
    protected function registerAutoloader() {
        spl_autoload_register(function($className) {
            $paths = [
                '../app/core/',
                '../app/controllers/',
                '../app/models/'
            ];
            
            foreach ($paths as $path) {
                $file = $path . $className . '.php';
                if (file_exists($file)) {
                    require_once $file;
                    return;
                }
            }
            
            throw new Exception("Class {$className} not found in paths: " . implode(', ', $paths));
        });
    }
    
    protected function parseURL() {
        if (!isset($_GET['url'])) {
            return [];
        }
        
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        
        if ($url === false) {
            throw new Exception("Invalid URL", 400);
        }
        
        return explode('/', $url);
    }
    
    protected function resolveController(&$url) {
        if (!empty($url[0])) {
            $controllerName = ucfirst($url[0]);
            $controllerFile = "../app/controllers/{$controllerName}Controller.php";
            
            if (file_exists($controllerFile)) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                throw new Exception("Controller {$controllerName} not found", 404);
            }
        }
        
        $controllerClass = $this->controller . 'Controller';
        if (!class_exists($controllerClass)) {
            throw new Exception("Controller class {$controllerClass} not loaded", 500);
        }
        
        $this->controller = new $controllerClass;
    }
    
    protected function resolveMethod(&$url) {
        if (isset($url[1])) {
            $method = $url[1];
            
            if (!method_exists($this->controller, $method)) {
                throw new Exception("Method {$method} not found in controller {$this->controller}", 404);
            }
            
            $this->method = $method;
            unset($url[1]);
        }
    }
    
    protected function resolveParams(&$url) {
        $this->params = $url ? array_values($url) : [];
    }
    
    protected function execute() {
        if (!is_callable([$this->controller, $this->method])) {
            throw new Exception("Method {$this->method} is not callable in controller", 500);
        }
        
        call_user_func_array(
            [$this->controller, $this->method], 
            $this->params
        );
    }
    
    protected function handleError(Exception $e) {
    if (!class_exists('ErrorController')) {
        die("Critical Framework Error: ErrorController not found");
    }

    $errorController = new ErrorController();
    $statusCode = $e->getCode() >= 400 && $e->getCode() < 600 ? $e->getCode() : 500;

    if ($statusCode === 404) {
        $errorController->notFound();
    } else {
        $errorController->serverError($e);
    }
    exit;
}
}
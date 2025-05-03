<?php
require_once '../config/config.php';
require_once '../app/core/App.php';

$app = new App();

spl_autoload_register(function($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    
    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    
    if (file_exists($file)) require $file;
});
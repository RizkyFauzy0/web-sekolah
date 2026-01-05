<?php
session_start();

// Load config
require_once '../config/config.php';

// Autoload core classes
spl_autoload_register(function ($class_name) {
    $coreFile = '../app/core/' . $class_name . '.php';
    if (file_exists($coreFile)) {
        require_once $coreFile;
    }
});

// Init core application
$app = new App();

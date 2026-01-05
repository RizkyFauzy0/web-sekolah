<?php

// Load config
require_once '../config/config.php';

// Session configuration - MUST be set BEFORE session_start()
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1); // Set to 1 for HTTPS

// Start session
session_start();

// Autoload core classes
spl_autoload_register(function ($class_name) {
    $coreFile = '../app/core/' . $class_name . '.php';
    if (file_exists($coreFile)) {
        require_once $coreFile;
    }
});

// Init core application
$app = new App();

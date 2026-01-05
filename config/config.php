<?php

// Environment Detection
define('ENVIRONMENT', 'production'); // or 'development'

// Error Reporting - Based on environment
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'web_sekolah');

// Base URL
define('BASE_URL', 'https://websekolah.gdvmedia.my.id/public/');

// App Root
define('APP_ROOT', dirname(dirname(__FILE__)));

// Site Name
define('SITE_NAME', 'Website Sekolah');

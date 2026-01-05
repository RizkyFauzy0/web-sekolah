<?php

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'web_sekolah');

// Base URL
define('BASE_URL', 'http://localhost/web-sekolah/public/');

// App Root
define('APP_ROOT', dirname(dirname(__FILE__)));

// Site Name
define('SITE_NAME', 'Website Sekolah');

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS

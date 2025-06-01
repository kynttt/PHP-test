<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'auth_test');
define('DB_USER', 'postgres');
define('DB_PASS', 'Yanuric09'); // Change this to your actual password

// CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
?> 
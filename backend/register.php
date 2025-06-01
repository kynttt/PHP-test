<?php
require_once 'db.php';

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode([
        'status' => 'error',
        'message' => 'Method not allowed'
    ]));
}

// Get JSON input
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Validate input
if (!isset($data['email']) || !isset($data['password'])) {
    http_response_code(400);
    die(json_encode([
        'status' => 'error',
        'message' => 'Email and password are required'
    ]));
}

$email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
if (!$email) {
    http_response_code(400);
    die(json_encode([
        'status' => 'error',
        'message' => 'Invalid email format'
    ]));
}

if (strlen($data['password']) < 6) {
    http_response_code(400);
    die(json_encode([
        'status' => 'error',
        'message' => 'Password must be at least 6 characters long'
    ]));
}

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Check if email already exists
    $stmt = $conn->prepare('SELECT id FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch()) {
        http_response_code(400);
        die(json_encode([
            'status' => 'error',
            'message' => 'Email already registered'
        ]));
    }

    // Hash password and insert user
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
    $stmt->execute([
        'email' => $email,
        'password' => $hashedPassword
    ]);

    echo json_encode([
        'status' => 'success',
        'message' => 'User registered successfully'
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Registration failed: ' . $e->getMessage()
    ]);
}
?> 
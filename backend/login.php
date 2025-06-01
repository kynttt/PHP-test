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

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Get user by email
    $stmt = $conn->prepare('SELECT id, password FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($data['password'], $user['password'])) {
        http_response_code(401);
        die(json_encode([
            'status' => 'error',
            'message' => 'Invalid email or password'
        ]));
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Login successful',
        'user_id' => $user['id']
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Login failed: ' . $e->getMessage()
    ]);
}
?> 
<?php
// config.php dengan environment variables
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Ambil dari environment variables (lebih aman)
$host = $_ENV['DB_HOST'] ?? 'ep-cool-darkness-123456.us-east-2.aws.neon.tech';
$dbname = $_ENV['DB_NAME'] ?? 'antrian';
$username = $_ENV['DB_USER'] ?? 'username';
$password = $_ENV['DB_PASS'] ?? 'password';
$port = $_ENV['DB_PORT'] ?? '5432';

try {
    $conn = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => false
        ]
    );
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Database connection failed: " . $e->getMessage()]);
    exit;
}

function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>

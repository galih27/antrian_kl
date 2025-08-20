<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Konfigurasi PostgreSQL
$host = 'your-postgres-host';
$port = '5432';
$dbname = 'antrian';
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

// Buat koneksi PostgreSQL
try {
    $conn = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
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

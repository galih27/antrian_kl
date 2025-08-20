<?php
// config.php untuk Neon.tech PostgreSQL
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Connection string dari Neon.tech
$connectionString = "postgresql://username:password@ep-cool-darkness-123456.us-east-2.aws.neon.tech/antrian_db";

// Parse connection string
$url = parse_url($connectionString);

$host = $url['host']; // ep-cool-darkness-123456.us-east-2.aws.neon.tech
$dbname = ltrim($url['path'], '/'); // antrian_db
$username = $url['user']; // username
$password = $url['pass']; // password
$port = $url['port'] ?? '5432'; // default PostgreSQL port

// Buat koneksi PDO
try {
    $conn = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_EMULATE_PREPARES => false
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

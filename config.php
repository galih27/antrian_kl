<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'antrian_db';
// Buat koneksi
$conn = new mysqli($host, $user, $password, $dbname);
// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// Set charset
$conn->set_charset("utf8");
// Fungsi untuk sanitasi input
function sanitize($data) {
    global $conn;
    return $conn->real_escape_string(htmlspecialchars(strip_tags(trim($data))));
}
?>
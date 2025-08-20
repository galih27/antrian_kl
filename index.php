<?php
require 'config.php';

// Tambah antrian baru (PostgreSQL version)
if (isset($_POST['tambah'])) {
    $nama = sanitize($_POST['nama']);
    $jenis = sanitize($_POST['jenis']);
    
    // Query untuk PostgreSQL
    $sql = "INSERT INTO antrian (nomor, nama, jenis) 
            SELECT 
                CONCAT('$jenis-', LPAD((COUNT(*) + 1)::text, 3, '0')), 
                '$nama', 
                '$jenis'
            FROM antrian 
            WHERE jenis = '$jenis'";
    
    try {
        $conn->exec($sql);
        $success = "Antrian berhasil ditambahkan!";
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Hapus antrian
if (isset($_GET['hapus'])) {
    $id = sanitize($_GET['hapus']);
    try {
        $stmt = $conn->prepare("DELETE FROM antrian WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Ambil data antrian
try {
    $stmt = $conn->query("SELECT * FROM antrian ORDER BY created_at DESC");
    $antrian_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Error: " . $e->getMessage();
}
?>

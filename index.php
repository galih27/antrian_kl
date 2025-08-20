<?php
require 'config.php';

// Tambah antrian baru (PostgreSQL version)
if (isset($_POST['tambah'])) {
    $nama = sanitize($_POST['nama']);
    $jenis = sanitize($_POST['jenis']);
    
    // Query yang sesuai dengan PostgreSQL
    $sql = "INSERT INTO antrian (nomor, nama, jenis) 
            VALUES (
                CONCAT('$jenis-', LPAD((SELECT COUNT(*) FROM antrian WHERE jenis='$jenis')::INTEGER + 1, 3, '0')), 
                '$nama', 
                '$jenis'
            )";
    
    try {
        $conn->exec($sql);
        $success = "Antrian berhasil ditambahkan!";
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Hapus antrian (PostgreSQL version)
if (isset($_GET['hapus'])) {
    $id = sanitize($_GET['hapus']);
    try {
        $conn->exec("DELETE FROM antrian WHERE id='$id'");
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

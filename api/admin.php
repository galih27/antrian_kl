<?php
require './config.php';

header('Content-Type: text/html; charset=utf-8');

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['action']) && $input['action'] === 'tambah') {
        $nama = sanitize($input['nama']);
        $jenis = sanitize($input['jenis']);
        
        $sql = "INSERT INTO antrian (nomor, nama, jenis) 
                SELECT 
                    CONCAT('$jenis-', LPAD((COUNT(*) + 1)::text, 3, '0')), 
                    '$nama', 
                    '$jenis'
                FROM antrian 
                WHERE jenis = '$jenis'";
        
        try {
            $conn->exec($sql);
            echo json_encode(["success" => "Antrian berhasil ditambahkan!"]);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Error: " . $e->getMessage()]);
        }
        exit;
    }
}

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['hapus'])) {
        $id = sanitize($_GET['hapus']);
        try {
            $stmt = $conn->prepare("DELETE FROM antrian WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            echo json_encode(["success" => "Antrian berhasil dihapus!"]);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Error: " . $e->getMessage()]);
        }
        exit;
    }
}

// Jika bukan API request, tampilkan HTML
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Antrian Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- HTML content tetap di sini -->
    <script>
    // JavaScript untuk handle form submission via API
    document.getElementById('tambahForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = {
            action: 'tambah',
            nama: document.querySelector('[name="nama"]').value,
            jenis: document.querySelector('[name="jenis"]').value
        };
        
        const response = await fetch('/api/admin', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });
        
        const result = await response.json();
        if (result.success) {
            alert(result.success);
            location.reload();
        } else {
            alert(result.error);
        }
    });
    </script>
</body>
</html>

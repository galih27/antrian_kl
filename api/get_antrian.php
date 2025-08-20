<?php
require 'config.php';
header('Content-Type: application/json');

try {
    $result = $conn->query("SELECT * FROM antrian ORDER BY created_at ASC");
    $antrian = $result->fetchAll(PDO::FETCH_ASSOC);
    
    $current = $antrian[0] ?? null;
    $next = array_slice($antrian, 1, 5);
    
    echo json_encode([
        'current' => $current ? [
            'nomor' => $current['nomor'],
            'nama' => $current['nama'],
            'jenis' => $current['jenis']
        ] : null,
        'next' => array_map(function($item) {
            return [
                'nomor' => $item['nomor'],
                'nama' => $item['nama'],
                'jenis' => $item['jenis']
            ];
        }, $next)
    ]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>

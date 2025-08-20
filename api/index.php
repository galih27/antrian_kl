<?php
header('Content-Type: application/json');
echo json_encode([
    "message" => "Antrian Digital API", 
    "endpoints" => [
        "/api/admin - Admin interface",
        "/api/get_antrian - Get antrian data",
        "/api/tambah - Add new queue"
    ]
]);
?>

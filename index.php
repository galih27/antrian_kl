<?php
require 'config.php';

// Tambah antrian baru
if (isset($_POST['tambah'])) {
    $nama = sanitize($_POST['nama']);
    $jenis = sanitize($_POST['jenis']); // A, B, C, dll
    
    $sql = "INSERT INTO antrian (nomor, nama, jenis) VALUES (CONCAT('$jenis-', LPAD((SELECT COUNT(*) FROM antrian WHERE jenis='$jenis')+1, 3, '0')), '$nama', '$jenis')";
    
    if ($conn->query($sql) === TRUE) {
        $success = "Antrian berhasil ditambahkan!";
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Hapus antrian
if (isset($_GET['hapus'])) {
    $id = sanitize($_GET['hapus']);
    $conn->query("DELETE FROM antrian WHERE id='$id'");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Antrian Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-5">Admin Antrian Digital</h1>
        
        <?php if(isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        
        <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Tambah Antrian Baru
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Jenis Antrian</label>
                                <select name="jenis" class="form-select" required>
                                    <option value="A">A (Umum)</option>
                                    <option value="B">B (Prioritas)</option>
                                    <option value="C">C (Lansia/Ibu Hamil)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Pelanggan</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <button type="submit" name="tambah" class="btn btn-primary">Tambah Antrian</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        Daftar Antrian Hari Ini
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $conn->query("SELECT * FROM antrian ORDER BY created_at DESC");
                                    $no = 1;
                                    while($row = $result->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nomor'] ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><span class="badge bg-<?= 
                                            $row['jenis'] == 'A' ? 'primary' : 
                                            ($row['jenis'] == 'B' ? 'warning' : 'danger')
                                        ?>"><?= $row['jenis'] ?></span></td>
                                        <td>
                                            <a href="index.php?hapus=<?= $row['id'] ?>" class="btn btn-sm btn-danger" 
                                               onclick="return confirm('Hapus antrian ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Antrian Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/display.css">
</head>
<body>
    <div class="container">
        <div class="antrian-section">
            <div class="header">
                <h1>ANTRIAN DIGITAL</h1>
                <p>Sistem Antrian Terpadu</p>
            </div>
            
            <div class="antrian-display">
                <h2>Nomor Antrian Saat Ini</h2>
                <div class="current-antrian">
                    <span class="nomor" id="current-nomor">A-101</span>
                    <span class="jenis" id="current-jenis">UMUM</span>
                </div>
                <div class="nama-pelanggan" id="current-nama">Andi Wijaya</div>
                <div class="waktu" id="current-waktu"></div>
            </div>
            
            <div class="antrian-list">
                <h3>Daftar Antrian Berikutnya</h3>
                <div id="next-antrian">
                    <!-- Daftar antrian akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
        
        <div class="youtube-section">
            <h2>Informasi Pelayanan</h2>
            <div class="waktu" id="waktu-sekarang"></div>
            <div class="video-container">
                <iframe src="https://www.youtube.com/embed/Cm0TnaKnpmY?autoplay=1&mute=1&loop=1" 
                        allow="autoplay" 
                        allowfullscreen></iframe>
            </div>
            <div class="loket-info">
                <div class="loket">
                    <span>LOKET 1</span>
                    <span>A-101</span>
                </div>
                <div class="loket">
                    <span>LOKET 2</span>
                    <span>B-012</span>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/display.js"></script>
</body>
</html>

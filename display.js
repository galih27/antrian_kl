// Fungsi untuk mengupdate tampilan antrian
function updateAntrian() {
    fetch('get_antrian.php')
        .then(response => response.json())
        .then(data => {
            // Update antrian saat ini
            if (data.current) {
                document.getElementById('current-nomor').textContent = data.current.nomor;
                document.getElementById('current-nama').textContent = data.current.nama;
                document.getElementById('current-jenis').textContent = 
                    data.current.jenis === 'A' ? 'UMUM' : 
                    data.current.jenis === 'B' ? 'PRIORITAS' : 'KHUSUS';
                
                // Update warna jenis antrian
                const jenisElement = document.getElementById('current-jenis');
                jenisElement.className = 'jenis ' + 
                    (data.current.jenis === 'A' ? 'umum' : 
                     data.current.jenis === 'B' ? 'prioritas' : 'khusus');
                
                // Update waktu panggilan
                document.getElementById('current-waktu').textContent = 
                    'Dipanggil pada: ' + new Date().toLocaleTimeString('id-ID');
            }
            
            // Update daftar antrian berikutnya
            const nextAntrianElement = document.getElementById('next-antrian');
            nextAntrianElement.innerHTML = '';
            
            data.next.forEach(item => {
                const div = document.createElement('div');
                div.className = 'list-item';
                div.innerHTML = `
                    <span>${item.nomor}</span>
                    <span>${item.nama}</span>
                    <span class="badge ${item.jenis === 'A' ? 'umum' : 
                                      item.jenis === 'B' ? 'prioritas' : 'khusus'}">
                        ${item.jenis === 'A' ? 'UMUM' : 
                         item.jenis === 'B' ? 'PRIORITAS' : 'KHUSUS'}
                    </span>
                `;
                nextAntrianElement.appendChild(div);
            });
        });
}

// Fungsi untuk menampilkan waktu real-time
function updateWaktu() {
    const sekarang = new Date();
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    };
    document.getElementById('waktu-sekarang').textContent = sekarang.toLocaleDateString('id-ID', options);
}

// Jalankan fungsi pertama kali
updateAntrian();
updateWaktu();

// Update setiap 5 detik
setInterval(updateAntrian, 5000);
setInterval(updateWaktu, 1000);

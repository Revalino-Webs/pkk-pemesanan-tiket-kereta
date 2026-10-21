<?php
include 'koneksi.php';

echo "<h2>🔧 Setup Database Aplikasi KAI Tiket Kereta</h2>";
echo "<p style='color: #666;'>Membuat/memperbarui struktur database...</p>";
echo "<hr>";

// ===== TABEL USERS =====
echo "<h3>1. Membuat Tabel Users</h3>";
$createUsers = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL,
    birth DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if(mysqli_query($koneksi, $createUsers)){
    echo "✅ Tabel 'users' berhasil dibuat/ada<br>";
} else {
    echo "❌ Error: " . mysqli_error($koneksi) . "<br>";
}

// ===== TABEL STASIUN ASAL =====
echo "<h3>2. Membuat Tabel Stasiun Asal</h3>";
$createStasiunAsal = "CREATE TABLE IF NOT EXISTS stasiun_asal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stasiun_asal VARCHAR(100) NOT NULL
)";

if(mysqli_query($koneksi, $createStasiunAsal)){
    echo "✅ Tabel 'stasiun_asal' berhasil dibuat/ada<br>";
} else {
    echo "❌ Error: " . mysqli_error($koneksi) . "<br>";
}

// ===== TABEL STASIUN TUJUAN =====
echo "<h3>3. Membuat Tabel Stasiun Tujuan</h3>";
$createStasiunTujuan = "CREATE TABLE IF NOT EXISTS stasiun_tujuan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stasiun_tujuan VARCHAR(100) NOT NULL
)";

if(mysqli_query($koneksi, $createStasiunTujuan)){
    echo "✅ Tabel 'stasiun_tujuan' berhasil dibuat/ada<br>";
} else {
    echo "❌ Error: " . mysqli_error($koneksi) . "<br>";
}

// ===== TABEL PESANAN TIKET =====
echo "<h3>4. Membuat Tabel Pesanan Tiket</h3>";
$createPesanan = "CREATE TABLE IF NOT EXISTS pesanan_tiket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stasiun_asal VARCHAR(100),
    stasiun_tujuan VARCHAR(100),
    tanggal_berangkat DATE,
    nama_kereta VARCHAR(100),
    jam_keberangkatan VARCHAR(50),
    jumlah_penumpang INT,
    kelas_kereta VARCHAR(50),
    kursi_dipilih INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if(mysqli_query($koneksi, $createPesanan)){
    echo "✅ Tabel 'pesanan_tiket' berhasil dibuat/ada<br>";
} else {
    echo "❌ Error: " . mysqli_error($koneksi) . "<br>";
}

// ===== TABEL PEMBAYARAN =====
echo "<h3>5. Membuat Tabel Pembayaran</h3>";
$createPembayaran = "CREATE TABLE IF NOT EXISTS pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total_pembayaran DECIMAL(12, 2),
    kursi_dipilih INT,
    metode_pembayaran VARCHAR(50),
    tanggal_pembayaran TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if(mysqli_query($koneksi, $createPembayaran)){
    echo "✅ Tabel 'pembayaran' berhasil dibuat/ada<br>";
} else {
    echo "❌ Error: " . mysqli_error($koneksi) . "<br>";
}

// ===== TABEL KERETA =====
echo "<h3>6. Membuat Tabel Kereta</h3>";
$createKereta = "CREATE TABLE IF NOT EXISTS kereta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kereta VARCHAR(100),
    kursi_kereta INT
)";

if(mysqli_query($koneksi, $createKereta)){
    echo "✅ Tabel 'kereta' berhasil dibuat/ada<br>";
} else {
    echo "❌ Error: " . mysqli_error($koneksi) . "<br>";
}

echo "<hr>";
echo "<h3>✅ Setup Database Selesai!</h3>";
echo "<p><a href='dashboard.php' style='display: inline-block; padding: 12px 24px; background: #0066cc; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;'>Kembali ke Dashboard</a></p>";

mysqli_close($koneksi);
?>

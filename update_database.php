<?php
include 'koneksi.php';

echo "Memperbarui struktur database...<br><br>";

// Cek dan tambah kolom nama_kereta jika belum ada
$checkKereta = mysqli_query($koneksi, "SHOW COLUMNS FROM pesanan_tiket LIKE 'nama_kereta'");
if(mysqli_num_rows($checkKereta) == 0){
    $alterKereta = "ALTER TABLE pesanan_tiket ADD COLUMN nama_kereta VARCHAR(100) AFTER tanggal_berangkat";
    if(mysqli_query($koneksi, $alterKereta)){
        echo "✅ Kolom 'nama_kereta' berhasil ditambahkan<br>";
    } else {
        echo "❌ Error menambah kolom 'nama_kereta': " . mysqli_error($koneksi) . "<br>";
    }
} else {
    echo "ℹ️ Kolom 'nama_kereta' sudah ada<br>";
}

// Cek dan tambah kolom jam_keberangkatan jika belum ada
$checkJam = mysqli_query($koneksi, "SHOW COLUMNS FROM pesanan_tiket LIKE 'jam_keberangkatan'");
if(mysqli_num_rows($checkJam) == 0){
    $alterJam = "ALTER TABLE pesanan_tiket ADD COLUMN jam_keberangkatan VARCHAR(50) AFTER nama_kereta";
    if(mysqli_query($koneksi, $alterJam)){
        echo "✅ Kolom 'jam_keberangkatan' berhasil ditambahkan<br>";
    } else {
        echo "❌ Error menambah kolom 'jam_keberangkatan': " . mysqli_error($koneksi) . "<br>";
    }
} else {
    echo "ℹ️ Kolom 'jam_keberangkatan' sudah ada<br>";
}

echo "<br>================================<br>";
echo "✅ Database sudah diperbarui!<br>";
echo "================================<br>";
echo "<a href='dashboard.php'><button style='padding: 10px 20px; background: #0066cc; color: white; border: none; cursor: pointer; border-radius: 5px;'>Kembali ke Dashboard</button></a>";

mysqli_close($koneksi);
?>

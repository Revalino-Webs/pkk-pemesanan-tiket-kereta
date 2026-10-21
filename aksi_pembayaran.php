<?php
include 'koneksi.php';

// Proses pembayaran hanya jika form dikirim
if (isset($_POST['bayar'])) {
    
    // Validasi input
    if (!isset($_POST['total']) || empty(trim($_POST['total']))) {
        handleError('Total pembayaran tidak ditemukan!', 'pembayaran.php');
        exit;
    }

    if (!isset($_POST['nama_pemesan']) || empty(trim($_POST['nama_pemesan']))) {
        handleError('Nama pemesan tidak ditemukan!', 'pembayaran.php');
        exit;
    }

    if (!isset($_POST['kursi']) || empty(trim($_POST['kursi']))) {
        handleError('Pilih kursi terlebih dahulu!', 'pembayaran.php');
        exit;
    }

    if (!isset($_POST['metode_pembayaran']) || empty(trim($_POST['metode_pembayaran']))) {
        handleError('Pilih metode pembayaran!', 'pembayaran.php');
        exit;
    }

    // Sanitasi dan konversi tipe data
    $total = floatval($_POST['total']);
    $nama_pemesan = trim($_POST['nama_pemesan']);
    $kursi = intval($_POST['kursi']);
    $metode_pembayaran = trim($_POST['metode_pembayaran']);

    // Validasi nilai total
    if ($total <= 0) {
        handleError('Total pembayaran harus lebih dari 0!', 'pembayaran.php');
        exit;
    }

    // Validasi nomor kursi
    if ($kursi < 1 || $kursi > 20) {
        handleError('Nomor kursi tidak valid!', 'pembayaran.php');
        exit;
    }

    // Validasi metode pembayaran
    $metode_valid = ['BCA', 'Mandiri', 'BRI'];
    if (!in_array($metode_pembayaran, $metode_valid)) {
        handleError('Metode pembayaran tidak valid!', 'pembayaran.php');
        exit;
    }

    // Gunakan prepared statement untuk keamanan
    $query = "INSERT INTO pembayaran (nama_pemesan, total_pembayaran, kursi_dipilih, metode_pembayaran) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);

    if (!$stmt) {
        handleError('Kesalahan database: ' . mysqli_error($koneksi), 'pembayaran.php');
        exit;
    }

    // Bind parameter dengan tipe data yang tepat
    mysqli_stmt_bind_param($stmt, "sdis", $nama_pemesan, $total, $kursi, $metode_pembayaran);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        handleSuccess('Pembayaran berhasil atas nama ' . htmlspecialchars($nama_pemesan) . ' untuk Kursi ' . $kursi . ' melalui ' . $metode_pembayaran . '!', 'dashboard.php');
    } else {
        handleError('Pembayaran gagal: ' . mysqli_stmt_error($stmt), 'pembayaran.php');
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
    exit;
}

/**
 * Fungsi untuk menampilkan pesan error dengan redirect
 */
function handleError($message, $redirect) {
    echo "
    <script>
        alert('" . addslashes($message) . "');
        window.location.href='" . htmlspecialchars($redirect) . "';
    </script>
    ";
}

/**
 * Fungsi untuk menampilkan pesan sukses dengan redirect
 */
function handleSuccess($message, $redirect) {
    echo "
    <script>
        alert('" . addslashes($message) . "');
        window.location.href='" . htmlspecialchars($redirect) . "';
    </script>
    ";
}
?>
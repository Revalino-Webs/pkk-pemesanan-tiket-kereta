<?php
session_start();
echo $_SESSION['email'];
include 'koneksi.php';

// Cek apakah user sudah login
if(!isset($_SESSION['email'])){
    header("Location: Login.php");
    exit;
}

// Ambil data user dari database
$email_user = $_SESSION['email'];
$query_user = mysqli_query($koneksi, "SELECT name FROM user WHERE email='$email_user'");
$user_data = mysqli_fetch_assoc($query_user);
$nama_pemesan = $user_data ? $user_data['name'] : 'Pengguna Tidak Diketahui';

// Ambil data pesanan tiket terakhir untuk mendapatkan kursi yang dipilih
$query_pesanan = mysqli_query($koneksi, "SELECT kursi_penumpang FROM pesanan_tiket ORDER BY id DESC LIMIT 1");
$pesanan_data = mysqli_fetch_assoc($query_pesanan);
$kursi_dipilih = $pesanan_data ? $pesanan_data['kursi_penumpang'] : 0;

$total = isset($_GET['total']) ? floatval($_GET['total']) : 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>

    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="LoginContainer">

    <div class="header">
        <h1>Pembayaran Tiket</h1>
        <p>Silahkan lakukan pembayaran</p>
    </div>

    <div style="background: #f5f5f5; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
        <p style="margin: 0; font-weight: bold;">Nama Pemesan: <span style="color: #0066cc;"><?php echo htmlspecialchars($nama_pemesan); ?></span></p>
        <p style="margin: 10px 0 0 0; font-weight: bold;">Kursi Dipilih: <span style="color: #0066cc;">Kursi <?php echo $kursi_dipilih; ?></span></p>
    </div>

    <form action="aksi_pembayaran.php" method="POST" onsubmit="return validateForm()">

        <div class="inputgrup">
            <label>Total Pembayaran</label>
            <input
            type="text"
            value="Rp <?php echo number_format($total); ?>"
            readonly>

            <!-- input hidden untuk kirim total -->
            <input
            type="hidden"
            name="total"
            value="<?php echo $total; ?>">

            <!-- input hidden untuk kirim nama pemesan -->
            <input
            type="hidden"
            name="nama_pemesan"
            value="<?php echo htmlspecialchars($nama_pemesan); ?>">

            <!-- input hidden untuk kirim kursi yang dipilih -->
            <input
            type="hidden"
            name="kursi"
            value="<?php echo $kursi_dipilih; ?>">
        </div>

        <div class="inputgrup">
            <label>Metode Pembayaran</label>
            <div class="pembayaran_metode">
                <label for="bca">
                    <input type="radio" id="bca" name="metode_pembayaran" value="BCA" required>
                    BCA
                </label>
            </div>
            <div class="pembayaran_metode">
                <label for="mandiri">
                    <input type="radio" id="mandiri" name="metode_pembayaran" value="Mandiri" required>
                    Mandiri
                </label>
            </div>
            <div class="pembayaran_metode">
                <label for="bri">
                    <input type="radio" id="bri" name="metode_pembayaran" value="BRI" required>
                    BRI
                </label>
            </div>
        </div>

        <button
        type="submit"
        name="bayar"
        class="buttonklik">
            Bayar Sekarang
        </button>

    </form>

</div>

<script>
    function validateForm() {
        const metode = document.querySelector('input[name="metode_pembayaran"]:checked');

        if (!metode) {
            alert('Silahkan pilih metode pembayaran!');
            return false;
        }

        return true;
    }
</script>

</body>
</html>
<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['email'])){
  header("Location: Login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - KAI BALI</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="app-shell">
    <header class="topbar">
      <div class="brand-block">
        <div class="brand-mark">K</div>
        <div>
          <p class="brand-label">KAI BALI</p>
          <span class="brand-subtitle">Aplikasi Tiket</span>
        </div>
      </div>

      

      <div class="top-actions">

<?php if(isset($_SESSION['email'])){ ?>

    <span class="user-login">
        <?php echo $_SESSION['email']; ?>
    </span>

    <a href="Logout.php" class="button-logout">
        Logout
    </a>

<?php } else { ?>

    <a href="Login.php" class="button-outline">
        Masuk
    </a>

    <a href="Hal2.php" class="button-primary">
        Daftar
    </a>

<?php } ?>

</div>
    </header>

    <main class="page-content">
      <section class="hero-block">
        <div class="hero-copy">
          <p class="eyebrow">Dashboard Tiket Kereta</p>
          <h1>Pesan tiket kereta dengan cepat dan mudah.</h1>
          <p class="hero-description">Jelajahi jadwal rute, buat akun baru, dan login untuk kelola perjalananmu. Semua tersedia di satu halaman.</p>
          <div class="hero-actions">
            <a href="Hal3.php" class="button-primary">Pesan Tiket</a>
            <a href="Hal5.php" class="button-primary">Isi Data Penumpang</a>
            <a href="history_tiket.php" class="button-primary">History Pembelian</a>
            <a href="scan_tiket.php" class="button-primary" style="background: linear-gradient(135deg, #27ae60, #2ecc71);">Scan Tiket</a>
          </div>
        </div>

        <div class="hero-card">
          <div class="hero-card-header">
            <span>Promo Hari Ini</span>
            <strong>Diskon Kursi Ekonomi</strong>
          </div>
          <div class="hero-card-body">
            <div class="stat-item">
              <span>Rute Populer</span>
              <strong>Denpasar - Jakarta</strong>
            </div>
            <div class="stat-item">
              <span>Estimasi</span>
              <strong>3 jam 40 menit</strong>
            </div>
          </div>
        </div>
      </section>

      <section class="feature-grid">
        <article class="feature-card">
          <h2>Mudah</h2>
          <p>Antarmuka sederhana untuk proses pemesanan dan pendaftaran.</p>
        </article>
        <article class="feature-card">
          <h2>Aman</h2>
          <p>Data tersimpan dengan baik dan mudah dilacak.</p>
        </article>
        <article class="feature-card">
          <h2>Responsif</h2>
          <p>Layout yang nyaman di layar laptop maupun ponsel.</p>
        </article>
      </section>
    </main>
  </div>
</body>
</html>
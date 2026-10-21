<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['email'])){
  header("Location: Login.php");
  exit;
}

// Query untuk mendapatkan history pembelian tiket
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$hari_ini = date('Y-m-d');

if($filter == 'berangkat') {
    $historyQuery = mysqli_query($koneksi, "SELECT * FROM pesanan_tiket WHERE tanggal_berangkat >= '$hari_ini' ORDER BY tanggal_berangkat ASC");
} elseif($filter == 'selesai') {
    $historyQuery = mysqli_query($koneksi, "SELECT * FROM pesanan_tiket WHERE tanggal_berangkat < '$hari_ini' ORDER BY tanggal_berangkat DESC");
} else {
    $historyQuery = mysqli_query($koneksi, "SELECT * FROM pesanan_tiket ORDER BY tanggal_berangkat DESC");
}
if(!$historyQuery){
    die("Error query pesanan_tiket: " . mysqli_error($koneksi));
}
if(!$historyQuery){
    die("Error query pesanan_tiket: " . mysqli_error($koneksi));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pembelian Tiket</title>
    <link rel="stylesheet" href="login.css">
    <style>
        body {
            display: block;
            padding: 0;
            background: #f5f7fa;
        }

        .history-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        .history-header {
            margin-bottom: 30px;
        }
        
        .history-header h1 {
            color: #1a3a6b;
            margin-bottom: 8px;
            font-size: 2rem;
        }
        
        .history-header p {
            color: #666;
            font-size: 16px;
        }
        
        .table-wrapper {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table thead {
            background: linear-gradient(135deg, #0d4da3 0%, #1760c8 100%);
            color: white;
        }
        
        table th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }
        
        table td {
            padding: 14px 16px;
            border-bottom: 1px solid #e8eef5;
            font-size: 14px;
        }
        
        table tbody tr:hover {
            background: #f8f9fc;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
        }
        
        .status-active {
            background: #e8f5e9;
            color: #2e7d32;
        }
        
        .status-completed {
            background: #e3f2fd;
            color: #1565c0;
        }
        
        .no-data {
            text-align: center;
            padding: 50px 20px;
            color: #999;
        }

        .no-data h3 {
            color: #666;
            margin-bottom: 10px;
        }
        
        .back-button {
            display: inline-block;
            margin-bottom: 25px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #2d6cff, #4f8dff);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 12px rgba(45, 108, 255, 0.3);
        }
        
        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(45, 108, 255, 0.4);
        }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="brand-block">
            <div class="brand-mark">K</div>
            <div>
                <p class="brand-label">KAI BALI</p>
                <span class="brand-subtitle">Aplikasi Tiket</span>
            </div>
        </div>
        <div class="top-actions">
            <span class="user-login"><?php echo $_SESSION['email']; ?></span>
            <a href="logout.php" class="button-logout">Logout</a>
        </div>
    </div>

    <div class="history-container">
        <a href="dashboard.php" class="back-button">← Kembali ke Dashboard</a>
        
        <div class="history-header">
            <h1>📋 History Pembelian Tiket</h1>
            <p>Daftar riwayat pembelian tiket kereta Anda</p>
        </div>

        <!-- TOMBOL FILTER STATUS -->
        <div class="filter-buttons" style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="history_tiket.php" style="padding: 10px 20px; background: <?php echo ($filter == '') ? '#2d6cff' : 'white'; ?>; color: <?php echo ($filter == '') ? 'white' : '#2d6cff'; ?>; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; border: 2px solid #2d6cff; transition: 0.3s;">Semua Tiket</a>
            <a href="history_tiket.php?filter=berangkat" style="padding: 10px 20px; background: <?php echo ($filter == 'berangkat') ? '#2d6cff' : 'white'; ?>; color: <?php echo ($filter == 'berangkat') ? 'white' : '#2d6cff'; ?>; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; border: 2px solid #2d6cff; transition: 0.3s;">🟢 Akan Berangkat</a>
            <a href="history_tiket.php?filter=selesai" style="padding: 10px 20px; background: <?php echo ($filter == 'selesai') ? '#2d6cff' : 'white'; ?>; color: <?php echo ($filter == 'selesai') ? 'white' : '#2d6cff'; ?>; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; border: 2px solid #2d6cff; transition: 0.3s;">🔵 Sudah Selesai</a>
        </div>
        
        <div class="table-wrapper">
            <?php
            if(mysqli_num_rows($historyQuery) > 0) {
            ?>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 12%;">Stasiun Asal</th>
                            <th style="width: 12%;">Stasiun Tujuan</th>
                            <th style="width: 12%;">Tanggal</th>
                            <th style="width: 15%;">Kereta</th>
                            <th style="width: 10%;">Jam</th>
                            <th style="width: 10%;">Penumpang</th>
                            <th style="width: 10%;">Kelas</th>
                            <th style="width: 14%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while($row = mysqli_fetch_assoc($historyQuery)) {
                            $tanggal_berangkat = $row['tanggal_berangkat'];
                            
                            if($tanggal_berangkat > $hari_ini) {
                                $status = '🟢 Akan Berangkat';
                                $status_class = 'status-active';
                            } else {
                                $status = '🔵 Sudah Selesai';
                                $status_class = 'status-completed';
                            }
                        ?>
                        <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['stasiun_asal']); ?></td>
                                <td><?php echo htmlspecialchars($row['stasiun_tujuan']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['tanggal_berangkat'])); ?></td>
                                <td><?php echo htmlspecialchars($row['nama_kereta']); ?></td>
                                <td><?php echo htmlspecialchars($row['jam_keberangkatan']); ?></td>
                                <td><?php echo $row['jumlah_penumpang']; ?> orang</td>
                                <td><?php echo htmlspecialchars($row['kelas_kereta']); ?></td>
                                <td>
                                    <span class="status-badge <?php echo $status_class; ?>"><?php echo $status; ?></span>
                                    <br>
                                    <?php if($tanggal_berangkat >= $hari_ini) { ?>
                                        <!-- AKAN BERANGKAT -->
                                        <a href="detail_tiket.php?id=<?php echo $row['id']; ?>" style="display: inline-block; margin-top: 8px; padding: 8px 14px; background: #2d6cff; color: white; text-decoration: none; border-radius: 6px; font-size: 12px; font-weight: 600; margin-right: 5px;">📋 Lihat Tiket</a>
                                        <form style="display: inline-block; margin: 0;" method="POST" action="aksi_batalkan_tiket.php" onsubmit="return confirm('⚠️ PERHATIAN!\n\nApakah Anda yakin ingin membatalkan tiket ini?\n\nTindakan ini TIDAK DAPAT DIBATALKAN dan tiket akan hilang!');">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="action" value="batalkan">
                                            <button type="submit" style="margin-top: 8px; padding: 8px 14px; background: #e74c3c; color: white; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; vertical-align: middle;">❌ Batalkan</button>
                                        </form>
                                    <?php } else { ?>
                                        <!-- SUDAH SELESAI -->
                                        <a href="detail_tiket.php?id=<?php echo $row['id']; ?>" style="display: inline-block; margin-top: 8px; padding: 8px 14px; background: #2d6cff; color: white; text-decoration: none; border-radius: 6px; font-size: 12px; font-weight: 600; margin-right: 5px;">📋 Lihat Tiket</a>
                                        <a href="detail_tiket.php?id=<?php echo $row['id']; ?>" style="display: inline-block; margin-top: 8px; padding: 8px 14px; background: #27ae60; color: white; text-decoration: none; border-radius: 6px; font-size: 12px; font-weight: 600;">✓ Cetak Ulang</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <div class="no-data">
                    <h3>📭 Belum Ada Data Pembelian Tiket</h3>
                    <p>Mulai pesan tiket kereta Anda sekarang untuk melihat riwayat di sini</p>
                    <a href="Hal3.php" class="back-button" style="display: inline-block; margin-top: 15px;">Pesan Tiket Sekarang</a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>

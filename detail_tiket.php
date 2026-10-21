<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['email'])){
  header("Location: Login.php");
  exit;
}

// Ambil ID tiket dari URL
$tiket_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($tiket_id == 0) {
    die("ID Tiket tidak valid!");
}

// Query untuk mendapatkan detail tiket
$detailQuery = mysqli_query($koneksi, "SELECT * FROM pesanan_tiket WHERE id = $tiket_id");
if(!$detailQuery){
    die("Error: " . mysqli_error($koneksi));
}

$tiket = mysqli_fetch_assoc($detailQuery);
if(!$tiket) {
    die("Tiket tidak ditemukan!");
}

// Generate nomor tiket unik
$nomor_tiket = "KAI" . str_pad($tiket['id'], 6, "0", STR_PAD_LEFT);

// Tentukan harga berdasarkan kelas
$harga_tiket = 0;
if($tiket['kelas_kereta'] == 'Ekonomi'){
    $harga_tiket = 150000;
} elseif($tiket['kelas_kereta'] == 'Bisnis'){
    $harga_tiket = 300000;
} elseif($tiket['kelas_kereta'] == 'Eksekutif'){
    $harga_tiket = 500000;
}
$total = $harga_tiket * $tiket['jumlah_penumpang'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tiket Kereta - KAI BALI</title>
    <link rel="stylesheet" href="login.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            display: block;
            padding: 0;
            margin: 0;
            background: #f5f7fa;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .header-action {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            justify-content: space-between;
            align-items: center;
        }

        .btn-group {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 11px 22px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-back {
            background: #f0f3f8;
            color: #1a3a6b;
        }

        .btn-back:hover {
            background: #e0e8f2;
        }

        .btn-print {
            background: linear-gradient(135deg, #2d6cff, #4f8dff);
            color: white;
            box-shadow: 0 4px 12px rgba(45, 108, 255, 0.3);
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(45, 108, 255, 0.4);
        }

        .btn-download {
            background: #27ae60;
            color: white;
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
        }

        .btn-download:hover {
            transform: translateY(-2px);
            background: #229954;
        }

        /* E-TICKET DESIGN */
        .eticket {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .ticket-header {
            background: linear-gradient(135deg, #0d4da3 0%, #1760c8 100%);
            padding: 30px;
            color: white;
            text-align: center;
        }

        .ticket-logo {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .ticket-title {
            font-size: 14px;
            color: rgba(255,255,255,0.9);
            margin-bottom: 20px;
        }

        .ticket-number {
            background: rgba(255,255,255,0.2);
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .ticket-body {
            padding: 30px;
        }

        .route-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e8eef5;
        }

        .station {
            flex: 1;
        }

        .station-code {
            font-size: 32px;
            font-weight: bold;
            color: #0d4da3;
            margin-bottom: 5px;
        }

        .station-name {
            font-size: 13px;
            color: #666;
            margin-bottom: 8px;
        }

        .station-time {
            font-size: 18px;
            font-weight: bold;
            color: #1a3a6b;
        }

        .route-arrow {
            flex: 0.5;
            text-align: center;
            color: #2d6cff;
            font-size: 24px;
            padding: 0 15px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-item {
            padding: 15px;
            background: #f8f9fc;
            border-radius: 10px;
            border-left: 4px solid #2d6cff;
        }

        .info-label {
            font-size: 11px;
            color: #999;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #1a3a6b;
        }

        .price-section {
            background: linear-gradient(135deg, #f0f4ff 0%, #e8f0ff 100%);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .price-row.total {
            border-top: 2px solid rgba(45, 108, 255, 0.3);
            padding-top: 10px;
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #0d4da3;
        }

        .qr-section {
            text-align: center;
            padding: 20px;
            border-top: 2px solid #e8eef5;
        }

        .qr-code {
            width: 160px;
            height: 160px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            border: 2px solid #e0e0e0;
        }

        #qrcode {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #qrcode img {
            border-radius: 8px;
        }

        .qr-text {
            font-size: 12px;
            color: #999;
        }

        .ticket-footer {
            background: #f8f9fc;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e8eef5;
            font-size: 12px;
            color: #999;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            background: #4CAF50;
            color: white;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 15px;
        }

        @media print {
            body {
                background: white;
            }
            .header-action {
                display: none;
            }
            .container {
                padding: 0;
            }
            .eticket {
                box-shadow: none;
                border-radius: 0;
            }
        }

        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .route-section {
                flex-direction: column;
                gap: 15px;
            }
            .route-arrow {
                transform: rotate(90deg);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-action">
            <a href="history_tiket.php" class="btn btn-back">← Kembali</a>
            <div class="btn-group">
                <button class="btn btn-print" onclick="window.print()">🖨️ Print Tiket</button>
                <a href="#" class="btn btn-download" onclick="downloadPDF(); return false;">📥 Download PDF</a>
            </div>
        </div>

        <div class="eticket" id="tiketPrint">
            <!-- HEADER -->
            <div class="ticket-header">
                <div class="ticket-logo">🚂 KAI BALI</div>
                <div class="ticket-title">TIKET KERETA API</div>
                <div class="ticket-number"><?php echo $nomor_tiket; ?></div>
            </div>

            <!-- BODY -->
            <div class="ticket-body">
                <!-- RUTE PERJALANAN -->
                <div class="route-section">
                    <div class="station">
                        <div class="station-code"><?php echo substr($tiket['stasiun_asal'], 0, 3); ?></div>
                        <div class="station-name">KEBERANGKATAN</div>
                        <div class="station-time"><?php echo $tiket['jam_keberangkatan']; ?></div>
                        <div class="station-name" style="margin-top: 5px;"><?php echo $tiket['stasiun_asal']; ?></div>
                    </div>
                    <div class="route-arrow">→</div>
                    <div class="station" style="text-align: right;">
                        <div class="station-code"><?php echo substr($tiket['stasiun_tujuan'], 0, 3); ?></div>
                        <div class="station-name">TUJUAN</div>
                        <div class="station-name" style="margin-top: 5px;"><?php echo $tiket['stasiun_tujuan']; ?></div>
                    </div>
                </div>

                <!-- INFO PERJALANAN -->
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">📅 Tanggal Berangkat</div>
                        <div class="info-value"><?php echo date('d M Y', strtotime($tiket['tanggal_berangkat'])); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">🚂 Nama Kereta</div>
                        <div class="info-value"><?php echo $tiket['nama_kereta']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">👥 Jumlah Penumpang</div>
                        <div class="info-value"><?php echo $tiket['jumlah_penumpang']; ?> Orang</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">💺 Kelas Tiket</div>
                        <div class="info-value"><?php echo $tiket['kelas_kereta']; ?></div>
                    </div>
                </div>

                <!-- HARGA -->
                <div class="price-section">
                    <div class="price-row">
                        <span>Harga per tiket (<?php echo $tiket['kelas_kereta']; ?>)</span>
                        <span>Rp <?php echo number_format($harga_tiket); ?></span>
                    </div>
                    <div class="price-row">
                        <span>Jumlah penumpang</span>
                        <span><?php echo $tiket['jumlah_penumpang']; ?> orang</span>
                    </div>
                    <div class="price-row total">
                        <span>💰 TOTAL PEMBAYARAN</span>
                        <span>Rp <?php echo number_format($total); ?></span>
                    </div>
                </div>

                <!-- QR CODE -->
                <div class="qr-section">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo urlencode($nomor_tiket); ?>" alt="QR Code" style="border-radius: 8px; border: 2px solid #e0e0e0;">
                    <div class="qr-text">Tunjukkan QR code ini saat check-in</div>
                    <div class="status-badge">✓ TIKET AKTIF</div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="ticket-footer">
                <p>Terima kasih telah menggunakan layanan KAI BALI 🙏</p>
                <p>Harap simpan tiket ini hingga selesai perjalanan</p>
                <p>Dicetak pada: <?php echo date('d/m/Y H:i'); ?></p>
            </div>
        </div>
    </div>

    <script>
        function downloadPDF() {
            // Untuk fitur download PDF, bisa menggunakan library seperti html2pdf atau jsPDF
            // Untuk sekarang, gunakan print to PDF dari browser
            alert('Gunakan Ctrl+P atau tombol Print untuk download sebagai PDF');
            window.print();
        }
    </script>
</body>
</html>

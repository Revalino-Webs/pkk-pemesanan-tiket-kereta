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
    <title>Scan Tiket QR Code - KAI BALI</title>
    <link rel="stylesheet" href="login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsQR/1.4.0/jsQR.js"></script>
    <style>
        body {
            display: block;
            padding: 0;
            background: #f5f7fa;
        }

        .container {
            max-width: 600px;
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
            background: #f0f3f8;
            color: #1a3a6b;
        }

        .btn:hover {
            background: #e0e8f2;
        }

        .btn-back {
            background: #f0f3f8;
            color: #1a3a6b;
        }

        .btn-back:hover {
            background: #e0e8f2;
        }

        .scanner-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 20px;
        }

        .scanner-header {
            background: linear-gradient(135deg, #0d4da3 0%, #1760c8 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
        }

        .scanner-header h2 {
            margin: 0 0 5px 0;
            font-size: 20px;
        }

        .scanner-header p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .video-container {
            position: relative;
            margin-bottom: 20px;
            border-radius: 12px;
            overflow: hidden;
            background: #000;
        }

        #video, #canvas {
            width: 100%;
            display: block;
            border-radius: 12px;
        }

        #canvas {
            display: none;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .btn-scan {
            flex: 1;
            background: linear-gradient(135deg, #2d6cff, #4f8dff);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 12px rgba(45, 108, 255, 0.3);
        }

        .btn-scan:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(45, 108, 255, 0.4);
        }

        .btn-scan:active {
            transform: translateY(0);
        }

        .btn-stop {
            flex: 1;
            background: #ff6b6b;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: transform 0.2s;
            display: none;
        }

        .btn-stop:hover {
            background: #ff5252;
            transform: translateY(-2px);
        }

        .result-box {
            background: #f8f9fc;
            border: 2px solid #e8eef5;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            display: none;
        }

        .result-box.success {
            background: #e8f5e9;
            border-color: #4CAF50;
        }

        .result-box.error {
            background: #ffebee;
            border-color: #ff5252;
        }

        .result-box h3 {
            margin: 0 0 10px 0;
            color: #1a3a6b;
        }

        .result-box p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        .result-box .ticket-number {
            font-size: 18px;
            font-weight: bold;
            color: #0d4da3;
            margin: 10px 0;
            padding: 10px;
            background: white;
            border-radius: 8px;
            text-align: center;
        }

        .result-box .btn-detail {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #0d4da3;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
        }

        .result-box .btn-detail:hover {
            background: #0a3d7a;
        }

        .loading {
            text-align: center;
            padding: 20px;
            display: none;
        }

        .spinner {
            border: 4px solid #f0f3f8;
            border-top: 4px solid #2d6cff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .info-box {
            background: #e3f2fd;
            border-left: 4px solid #2d6cff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #1565c0;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px 10px;
            }

            .scanner-container {
                padding: 15px;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-action">
            <a href="dashboard.php" class="btn btn-back">← Kembali</a>
        </div>

        <div class="scanner-container">
            <div class="scanner-header">
                <h2>📱 Scan Tiket QR Code</h2>
                <p>Arahkan kamera ke QR code tiket</p>
            </div>

            <div class="info-box">
                ℹ️ Memungkinkan akses kamera untuk men-scan QR code tiket penumpang
            </div>

            <div class="video-container">
                <video id="video" playsinline></video>
                <canvas id="canvas"></canvas>
            </div>

            <div class="button-group">
                <button class="btn-scan" id="btnStart" onclick="startScanning()">🎥 Mulai Scan</button>
                <button class="btn-stop" id="btnStop" onclick="stopScanning()">⏹️ Berhenti</button>
            </div>

            <div class="loading" id="loading">
                <div class="spinner"></div>
                <p style="margin-top: 15px; color: #666;">Menginisialisasi kamera...</p>
            </div>

            <div class="result-box" id="resultBox">
                <h3 id="resultTitle"></h3>
                <div id="resultContent"></div>
            </div>
        </div>
    </div>

    <script>
        let video = document.getElementById('video');
        let canvas = document.getElementById('canvas');
        let canvasContext = canvas.getContext('2d');
        let isScanning = false;

        function startScanning() {
            document.getElementById('loading').style.display = 'block';
            document.getElementById('resultBox').style.display = 'none';
            document.getElementById('btnStart').style.display = 'none';
            document.getElementById('btnStop').style.display = 'block';
            isScanning = true;

            // Akses kamera
            navigator.mediaDevices.getUserMedia({ 
                video: { facingMode: 'environment' } 
            }).then(stream => {
                video.srcObject = stream;
                video.play();
                document.getElementById('loading').style.display = 'none';
                scanQRCode();
            }).catch(err => {
                document.getElementById('loading').style.display = 'none';
                showError('Tidak dapat mengakses kamera. Pastikan Anda memberikan izin akses kamera.');
            });
        }

        function stopScanning() {
            isScanning = false;
            const stream = video.srcObject;
            const tracks = stream.getTracks();
            tracks.forEach(track => track.stop());
            
            document.getElementById('btnStart').style.display = 'block';
            document.getElementById('btnStop').style.display = 'none';
            document.getElementById('resultBox').style.display = 'none';
        }

        function scanQRCode() {
            if (!isScanning) return;

            // Set canvas ukuran sama dengan video
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Draw video ke canvas
            canvasContext.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Get image data dari canvas
            const imageData = canvasContext.getImageData(0, 0, canvas.width, canvas.height);
            const data = imageData.data;

            // Decode QR code
            const code = jsQR(data, imageData.width, imageData.height, {
                inversionAttempts: 'dontInvert'
            });

            // Jika QR code ditemukan
            if (code) {
                stopScanning();
                processQRCode(code.data);
            } else {
                // Lanjutkan scanning
                requestAnimationFrame(scanQRCode);
            }
        }

        function processQRCode(data) {
            // Data berisi nomor tiket (misal: KAI000001)
            if (!data.startsWith('KAI')) {
                showError('QR Code tidak valid. Pastikan Anda men-scan QR code tiket KAI BALI.');
                return;
            }

            // Extract ID dari nomor tiket
            const ticketId = parseInt(data.substring(3));

            // Redirect ke halaman detail tiket dengan auto-scroll
            window.location.href = 'detail_tiket.php?id=' + ticketId + '&scanned=1';
        }

        function showError(message) {
            const resultBox = document.getElementById('resultBox');
            resultBox.className = 'result-box error';
            document.getElementById('resultTitle').textContent = '❌ Gagal Scanning';
            document.getElementById('resultContent').innerHTML = '<p>' + message + '</p>';
            resultBox.style.display = 'block';

            document.getElementById('btnStart').style.display = 'block';
            document.getElementById('btnStop').style.display = 'none';
        }
    </script>
</body>
</html>

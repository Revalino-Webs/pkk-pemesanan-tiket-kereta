<?php 
include 'koneksi.php';

if(isset($_POST['pesan'])){

    // Ambil data dari form
    $stasiun = mysqli_real_escape_string($koneksi, $_POST['stasiun']);
    $stasiun_tujuan = mysqli_real_escape_string($koneksi, $_POST['stasiun_tujuan']);
    $tanggal_berangkat = $_POST['tanggal_berangkat'];
    $pilih_kereta = mysqli_real_escape_string($koneksi, $_POST['pilih_kereta']);
    $jam_keberangkatan = $_POST['jam_keberangkatan'];
    $jumlah_penumpang = (int) $_POST['jumlah_penumpang'];
    $kelas_kereta = mysqli_real_escape_string($koneksi, $_POST['kelas_kereta']);

    // =========================
    // PILIH KURSI
    // =========================

    $pilih_kursi = "";

    if(isset($_POST['pilih_kursi'])){

        // Jika kursi lebih dari satu
        if(is_array($_POST['pilih_kursi'])){

            $pilih_kursi = implode(", ", $_POST['pilih_kursi']);

        } else {

            // Jika hanya satu kursi
            $pilih_kursi = $_POST['pilih_kursi'];

        }
    }

    // =========================
    // HARGA TIKET
    // =========================

    $harga_tiket = 0;

    if($kelas_kereta == 'Ekonomi'){
        $harga_tiket = 150000;
    }
    elseif($kelas_kereta == 'Bisnis'){
        $harga_tiket = 300000;
    }
    elseif($kelas_kereta == 'Eksekutif'){
        $harga_tiket = 500000;
    }

    // Total pembayaran
    $total = $harga_tiket * $jumlah_penumpang;

    // =========================
    // INSERT DATABASE
    // =========================

    $query = "INSERT INTO pesanan_tiket
    (
        stasiun_asal,
        stasiun_tujuan,
        tanggal_berangkat,
        nama_kereta,
        jam_keberangkatan,
        jumlah_penumpang,
        kelas_kereta,
        kursi_penumpang
    )
    VALUES
    (
        '$stasiun',
        '$stasiun_tujuan',
        '$tanggal_berangkat',
        '$pilih_kereta',
        '$jam_keberangkatan',
        '$jumlah_penumpang',
        '$kelas_kereta',
        '$pilih_kursi'
    )";

    $result = mysqli_query($koneksi, $query);

    // =========================
    // CEK HASIL
    // =========================

    if($result){

        header("Location: pembayaran.php?total=$total");
        exit;

    } else {

        echo "
        <script>
            alert('Pesanan gagal!');
        </script>
        ";

        echo mysqli_error($koneksi);
    }
}
?>
<?php
include 'koneksi.php';

// ambil data stasiun asal
$dataAsal = mysqli_query($koneksi,
"SELECT * FROM stasiun_asal");

// ambil data stasiun tujuan
$dataTujuan = mysqli_query($koneksi,
"SELECT * FROM stasiun_tujuan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket</title>

    <link rel="stylesheet" href="login.css">
</head>

<body>

<div class="LoginContainer">

    <div class="header">
        <h1>Acces By KAI</h1>
        <p>Tiket Kereta</p>
    </div>

<form action="aksi_pesan_tiket.php" method="POST">

    <!-- STASIUN ASAL -->
    <div class="inputgrup">

        <label for="StasiunAsal">
            Stasiun Asal
        </label>

        <select
        name="stasiun"
        id="StasiunAsal">

            <option value="">
                -- Pilih Stasiun Asal --
            </option>

            <?php
            while($asal = mysqli_fetch_assoc($dataAsal)){
            ?>

            <option
            value="<?php echo $asal['stasiun_asal']; ?>">

                <?php
                echo $asal['stasiun_asal'];
                ?>

            </option>

            <?php } ?>

        </select>

    </div>

    <!-- STASIUN TUJUAN -->
    <div class="inputgrup">

        <label for="StasiunTujuan">
            Stasiun Tujuan
        </label>

        <select
        name="stasiun_tujuan"
        id="StasiunTujuan">

            <option value="">
                -- Pilih Stasiun Tujuan --
            </option>

            <?php
            while($tujuan = mysqli_fetch_assoc($dataTujuan)){
            ?>

            <option
            value="<?php echo $tujuan['stasiun_tujuan']; ?>">

                <?php
                echo $tujuan['stasiun_tujuan'];
                ?>

            </option>

            <?php } ?>

        </select>

    </div>

    <!-- TANGGAL -->
    <div class="inputgrup">

        <label for="TanggalBerangkat">
            Tanggal Berangkat
        </label>

        <input
        type="date"
        id="TanggalBerangkat"
        name="tanggal_berangkat">

    </div>

    <!-- PILIHAN KERETA -->
    <div class="inputgrup">

        <label for="PilihKereta">
            Pilih Kereta
        </label>

        <select
        name="pilih_kereta"
        id="PilihKereta">

            <option value="">
                -- Pilih Kereta --
            </option>

            <option value="Ambarawa Express">
                Ambarawa Express
            </option>

            <option value="Harina">
                Harina
            </option>

            <option value="Srikandi">
                Srikandi
            </option>

            <option value="Gajayana">
                Gajayana
            </option>

        </select>

    </div>

    <!-- JAM KEBERANGKATAN -->
    <div class="inputgrup">

        <label for="JamKeberangkatan">
            Jam Keberangkatan
        </label>

        <select
        name="jam_keberangkatan"
        id="JamKeberangkatan">

            <option value="">
                -- Pilih Jam --
            </option>

            <option value="06:00">
                06:00 - Pagi
            </option>

            <option value="09:00">
                09:00 - Pagi
            </option>

            <option value="12:00">
                12:00 - Siang
            </option>

            <option value="15:00">
                15:00 - Sore
            </option>

            <option value="18:00">
                18:00 - Malam
            </option>

            <option value="21:00">
                21:00 - Malam
            </option>

        </select>

    </div>

    <!-- JUMLAH -->
    <div class="inputgrup">

        <label for="JumlahPenumpang">
            Jumlah Penumpang
        </label>

        <input
        type="number"
        id="JumlahPenumpang"
        name="jumlah_penumpang"
        placeholder="Jumlah Penumpang">

    </div>

    <!-- KELAS -->
    <div class="inputgrup">

        <label for="KelasKereta">
            Kelas Kereta
        </label>

        <select
        name="kelas_kereta"
        id="KelasKereta">

            <option value="Ekonomi">
                1. Ekonomi
            </option>

            <option value="Bisnis">
                2. Bisnis
            </option>

            <option value="Eksekutif">
                3. Eksekutif
            </option>

        </select>

    </div>

    <!-- PILIHAN KURSI -->
    <div class="inputgrup">

        <label for="PilihKursi">
            Pilih Kursi Kereta
        </label>

        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 8px; margin-top: 10px; padding: 15px; background: #f9f9f9; border-radius: 5px;">
            <?php
            // Generate pilihan kursi dari 1-20 dalam bentuk kotak
            for ($i = 1; $i <= 20; $i++) {
                echo "<input type='checkbox' name='pilih_kursi[]' id='kursi_$i' value='$i' style='display: none;'>";
                echo "<label for='kursi_$i' style='width: 100%; aspect-ratio: 1; display: flex; align-items: center; justify-content: center; border: 2px solid #ddd; border-radius: 5px; background: #fff; cursor: pointer; font-weight: bold; transition: all 0.3s; text-align: center;' onmouseover=\"this.style.background='#e0e0e0'\" onmouseout=\"document.getElementById('kursi_$i').checked ? this.style.background='#0066cc' : this.style.background='#fff'\" onclick=\"updateKursiStyle(this, $i)\">$i</label>";
            }
            ?>
        </div>

        <!-- Hidden input untuk validasi -->
        <input type="hidden" id="kursi_selected" name="kursi_selected" value="">

    </div>

    <style>
        input[type="checkbox"][name="pilih_kursi[]"]:checked + label {
            background: #0066cc !important;
            color: white;
            border-color: #0066cc;
        }
    </style>

    <script>
        function updateKursiStyle(element, kursiNumber) {
            // Update nilai hidden input
            document.getElementById('kursi_selected').value = kursiNumber;
        }

        // Validasi form sebelum submit
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            if(form) {
                form.addEventListener('submit', function(e) {
                    const kursiSelected = document.querySelector('input[name="pilih_kursi[]"]:checked');
                    if(!kursiSelected) {
                        e.preventDefault();
                        alert('Silahkan pilih kursi terlebih dahulu!');
                    }
                });
            }
        });
    </script>

    <button
    type="submit"
    id="Acces"
    name="pesan"
    class="buttonklik">

        Pesan Tiket

    </button>
    

</form>

</div>

</body>
</html>
<?php 
    include 'koneksi.php';
    if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $tanggallahir = $_POST['tanggallahir'];
    $namakontak = $_POST['namakontak'];

    // Query Insert 
    $query = "INSERT INTO biodata (nama, nik, tanggal_lahir, kontak) 
    VALUES('$nama', '$nik', '$tanggallahir','$namakontak')";

    $result = mysqli_query($koneksi, $query);

    if($result){
        echo "<script> alert('Berhasil menambahkan data penumpang!')
              window.location.href = 'Hal3.php';
              </script>";
    } else{
        echo "<script> alert('Gagal menambahkan data siswa!')
              window.location.href = 'Hal5.php';
              </script>";
    }
     }
     
?>
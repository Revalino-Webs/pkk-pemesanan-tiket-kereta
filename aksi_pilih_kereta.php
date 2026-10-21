<?php
    include 'koneksi.php';
    if(isset($_POST['pesan'])){
    $kereta = $_POST['kereta'];
    $kursi = $_POST['kursi_kereta'];
   
    // Query Insert 
    $query = "INSERT INTO kereta (nama_kereta, kursi_kereta) VALUES('$kereta', '$kursi')";

    $result = mysqli_query($koneksi, $query);

    if($result){
        echo "<script> alert('Berhasil menambahkan data siswa!')
              window.location.href = 'Hal4.php';
              </script>";
    } else{
        echo "<script> alert('Gagal menambahkan data siswa!')
              window.location.href = 'Hal4.php';
              </script>";
    }
     }
     
?>
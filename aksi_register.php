<?php 
    include 'koneksi.php';
    if(isset($_POST['simpan'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $birth = $_POST['birth'];

    // Query Insert 
    $query = "INSERT INTO user (name, email, pass, birth) VALUES('$name', '$email', '$pass','$birth')";

    $result = mysqli_query($koneksi, $query);

    if($result){
        echo "<script> alert('Berhasil menambahkan data siswa!')
              window.location.href = 'Hal2.php';
              </script>";
    } else{
        echo "<script> alert('Gagal menambahkan data siswa!')
              window.location.href = 'Hal2.php';
              </script>";
    }
     }
     
?>
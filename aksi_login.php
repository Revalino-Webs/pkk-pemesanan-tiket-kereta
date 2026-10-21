<?php

session_start();
include 'koneksi.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['pass'];

    // cek email
    $query = mysqli_query($koneksi,
    "SELECT * FROM user WHERE email='$email'");

    $cek = mysqli_num_rows($query);

    if($cek == 1){

        $data = mysqli_fetch_assoc($query);

        // cek password
        if($password == $data['pass']){

            $_SESSION['email'] = $data['email'];

            header("Location: dashboard.php");
            exit;

        }else{

            echo "
            <script>
                alert('pass salah!');
                window.location='login.php';
            </script>
            ";

        }

    }else{

        echo "
        <script>
            alert('email tidak ditemukan!');
            window.location='login.php';
        </script>
        ";

    }

}else{

    header("Location: login.php");

}

?>
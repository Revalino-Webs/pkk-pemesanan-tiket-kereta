<?php

$hostname = "localhost";
$username = "root";
$password = "";
$db_name  = "db_tiketkereta";

$koneksi = mysqli_connect($hostname, $username, $password, $db_name);

if(!$koneksi){
    die("Database gagal terhubung".mysqli_connect_error());
}

?>
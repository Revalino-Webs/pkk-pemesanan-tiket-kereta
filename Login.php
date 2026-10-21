<?php
session_start();

if(isset($_SESSION['email'])){
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="login.css">
</head>

<body>

<div class="LoginContainer">

    <div class="header">
        <h1>KAI BALI</h1>
        <p>Welcome To KAI BALI</p>
    </div>

    <form action="aksi_login.php" method="POST">

        <div class="inputgrup">
            <label for="email">email</label>

            <input
            type="text"
            id="email"
            name="email"
            placeholder="masukkan email"
            required>
        </div>

        <div class="inputgrup">
            <label for="pass">pass</label>

            <input
            type="password"
            id="pass"
            name="pass"
            placeholder="masukkan pass"
            required>
        </div>

        <button
        type="submit"
        id="login"
        class="buttonklik"
        name="login">

            Login

        </button>
        <p class="register-link">
            Don't have an account? <a href="Hal2.php">Register here</a>

    </form>

</div>

</body>
</html>
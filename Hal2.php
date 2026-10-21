<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="LoginContainer">

  <div class="header">
<h1>New Account</h1>

</div>
<form action="aksi_register.php" method='POST'>
    <div class="inputgrup">
        <label for="name">name</label>
        <input type="text"id="name" name='name' placeholder="masukkan name">
    </div>
    <div class="inputgrup">
        <label for="email">email</label>
        <input type="text"id="email" name='email' placeholder="masukkan email">
    </div>
    <div class="inputgrup">
        <label for="pass">pass</label>
        <input type="password"id="pass" name='pass' placeholder="masukkan pass">
    </div>
    <div class="inputgrup">
        <label for="birth">birth</label>
        <input type="date"id="birth" name='birth' placeholder="masukkan birth">
    </div>
    <button type="submit"id="Acces" name='simpan' class="buttonklik">Acces</button>
            <p class="login-link">
            Already have an account? <a href="Login.php">Login here</a>
</form>
</div>
</body>
</html>
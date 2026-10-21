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
<h1>Pilih Kereta & Kursi</h1>
</div>
<form action="aksi_pilih_kereta.php" method='POST'>
    <div class="inputgrup">
        <label for="selectkereta">pilih kereta</label>
        <select name="kereta" id="selectkereta">
        <option value="ambarawa">Ambarawa</option>
        <option value="harina">Harina</option>
    </select>
    </div>
    <div class="inputgrup">
        <label for="pilihkursi">pilih kursi</label>
        <select name="kursi_kereta" id="selectkursi">
        <option value="1">1</option>
        <option value="2">2</option>
    </select>
    </div>
    <button type="submit"id="Acces" name='pesan' class="buttonklik">Acces</button>
</form>
</div>
</body> 
</html>
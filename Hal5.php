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
<h1>Isi Data Penumpang</h1>
</div>
<form action="aksi_biodata.php" method='POST'>
    <div class="inputgrup">
        <label for="namalengkap">nama lengkap</label>
        <input type="text" id="namalengkap" name="nama">
    </div>
    <div class="inputgrup">
        <label for="nik">nik</label>
        <input type="text" id="nik" name="nik">
    </div>
     <div class="inputgrup">
        <label for="tanggallahir">tanggal lahir</label>
        <input type="date" id="tanggallahir" name="tanggallahir">
    </div>
     <div class="inputgrup">
        <label for="nomorkontak">nomor kontak</label>
        <input type="text" id="nomorkontak" name="nomorkontak">
    </div>
    <button type="submit"id="Acces" name='simpan' class="buttonklik">Acces</button>
</form>
</div>
</body> 
</html>
<?php
$nim = $_GET['nim']; // Mengambil NIM dari URL

$curl = curl_init();

// GET request untuk mendapatkan data mahasiswa berdasarkan NIM
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8080/mahasiswa/' . $nim,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
curl_close($curl);

if ($response === false) {
  echo "Error: " . curl_error($curl);
} else {
  $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  if ($httpCode != 200) {
    echo "HTTP Error: " . $httpCode;
  } else {
    $mahasiswa = json_decode($response, true);
    if (is_array($mahasiswa) && count($mahasiswa) > 0) {
      $data = $mahasiswa['data'];

      // Data yang ingin diedit
      $nim = $data['nim'];
      $nama = $data['nama'];
      $angkatan = $data['angkatan'];
      $semester = $data['semester'];
      $ipk = $data['IPK'];
      $email = $data['email'];
      $telepon = $data['telepon'];
    } else {
      echo "Data not found.";
      exit();
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Data Mahasiswa</title>
  <link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
    <h2>Edit Data Mahasiswa</h2>
    <form class="card" action="submit_edit.php" method="POST">
      <label for="nim">NIM:</label>
      <input type="text" id="nim" name="nim" value="<?php echo $nim; ?>"><br>

      <label for="nama">Nama:</label>
      <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required><br>

      <label for="angkatan">Angkatan:</label>
      <input type="text" id="angkatan" name="angkatan" value="<?php echo $angkatan; ?>" required><br>

      <label for="semester">Semester:</label>
      <input type="text" id="semester" name="semester" value="<?php echo $semester; ?>" required><br>

      <label for="ipk">IPK:</label>
      <input type="text" id="ipk" name="ipk" value="<?php echo $ipk; ?>" required><br>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br>

      <label for="telepon">Telepon:</label>
      <input type="text" id="telepon" name="telepon" value="<?php echo $telepon; ?>" required><br>

      <input type="submit" value="Simpan">
    </form>
</body>
</html>

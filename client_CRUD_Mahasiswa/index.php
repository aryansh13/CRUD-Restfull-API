<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <h2>Daftar Mahasiswa</h2>
    <a href="tambah_data.php"><button type="button" class="tambah-button">Tambahkan Data Mahasiswa</button></a>
    <table>
        <tr>
            <th class="border-kiri">NIM</th>
            <th>Nama</th>
            <th>Angkatan</th>
            <th>Semester</th>
            <th>IPK</th>
            <th>Email</th>
            <th>Telepon</th>
            <th class="border-kanan">Aksi</th>
        </tr>
        <?php
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://localhost:8080/mahasiswa/',
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
              foreach ($mahasiswa['data'] as $data) {
                echo "<tr>";
                echo "<td>" . $data['nim'] . "</td>";
                echo "<td>" . $data['nama'] . "</td>";
                echo "<td>" . $data['angkatan'] . "</td>";
                echo "<td>" . $data['semester'] . "</td>";
                echo "<td>" . $data['IPK'] . "</td>";
                echo "<td>" . $data['email'] . "</td>";
                echo "<td>" . $data['telepon'] . "</td>";
                echo "<td class='button-container'><a class='edit-button' type='submit' href=\"edit_data.php?nim=" . $data['nim'] . "\"><i class='fas fa-edit'></i></a>";
                echo "<form action='hapus_data.php' id='hapusButton'  method='POST'>";
                echo "<input type='hidden' name='nim' value='" . $data['nim'] . "'>";
                echo "<button type='submit' class='delete-button'><i class='fas fa-trash-alt'></button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            
            } else {
              echo "No data available.";
            }
          }
        }
        ?>
    </table>
    
    <script src="main.js"></script>
</body>
</html>

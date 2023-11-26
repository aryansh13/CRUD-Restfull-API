<?php
$curl = curl_init();

// POST request
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8080/mahasiswa/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode(array(
    "nim" => $_POST["nim"],
    "nama" => $_POST["nama"],
    "angkatan" => $_POST["angkatan"],
    "semester" => $_POST["semester"],
    "IPK" => $_POST["ipk"],
    "email" => $_POST["email"],
    "telepon" => $_POST["telepon"]
  )),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
echo $response;

if ($response === false) {
    echo "Error: " . curl_error($curl);
  } else {
    echo $response;
    // Redirect to index.html after successful POST request
    header("Location: index.php");
  }

// PUT request
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8080/mahasiswa/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_POSTFIELDS => json_encode(array(
    "nim" => $_POST["nim"],
    "nama" => $_POST["nama"],
    "angkatan" => $_POST["angkatan"],
    "semester" => $_POST["semester"],
    "IPK" => $_POST["ipk"],
    "email" => $_POST["email"],
    "telepon" => $_POST["telepon"]
  )),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
echo $response;

// DELETE request
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8080/mahasiswa/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => 'DELETE',
));

$response = curl_exec($curl);
echo $response;

curl_close($curl);
header("Location: index.php");
?>

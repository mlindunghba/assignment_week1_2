<?php
require_once "lib/MahasiswaClass.php";

$mahasiswa = new MahasiswaClass();

// Fetch records and encode as JSON
$jsonData = $mahasiswa->read();

header('Content-Type: application/json');
echo $jsonData;

?>
<?php
require_once "lib/MahasiswaClass.php";

$mahasiswa = new MahasiswaClass();

$jsonData = '[
    {"id": 37}
]';
header('Content-Type: application/json');
echo $mahasiswa->delete($jsonData);
?>
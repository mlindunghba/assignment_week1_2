<?php
require_once "lib/MahasiswaClass.php";

$mahasiswa = new MahasiswaClass();
$jsonData = '[
    {"id": 36, "nama_lengkap": "John Doe", "jurusan": "Informatika", "jenjang": "S2"},
    {"id": 37, "nama_lengkap": "John Doe2", "jurusan": "Informatika2", "jenjang": "S2"}
]';

header('Content-Type: application/json');
echo $mahasiswa->update($jsonData);
?>
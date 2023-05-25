<?php
require_once "lib/MahasiswaClass.php";

$mahasiswa = new MahasiswaClass();

$jsonData = '[
                {"nama_lengkap": "Moch Lindung", "jurusan": "Informatika", "jenjang": "S1"}, 
                {"nama_lengkap": "Moch Lindung2", "jurusan": "Informatika", "jenjang": "S2"}
]';

header('Content-Type: application/json');

echo $mahasiswa->insert($jsonData);

?>
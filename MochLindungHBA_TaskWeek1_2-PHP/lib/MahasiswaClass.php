<?php

class MahasiswaClass{
    private $mysqli;

    public function __construct() {
        $hostname = "localhost"; 
        $username = "root";
        $password = ""; 
        $database = "db_kampus";

        $this->mysqli = new mysqli($hostname, $username, $password, $database);

        if ($this->mysqli->connect_error) {
            die('Connection failed: ' . $this->mysqli->connect_error);
        }
    }

    public function read()
    {
        $result = $this->mysqli->query('SELECT * FROM mahasiswa');

        $data = array();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return json_encode($data);
    }

    public function insert($jsonData)
    {
        $data = json_decode($jsonData, true);

        if (is_array($data)) {
            foreach ($data as $row) {
                $nama_lengkap = $this->mysqli->real_escape_string($row['nama_lengkap']);
                $jurusan = $this->mysqli->real_escape_string($row['jurusan']);
                $jenjang = $this->mysqli->real_escape_string($row['jenjang']);

                $query = "INSERT INTO mahasiswa (nama_lengkap, jurusan, jenjang) VALUES ('$nama_lengkap', '$jurusan', '$jenjang')";

                if (!$this->mysqli->query($query)) {
                    echo 'Error inserting data: ' . $this->mysqli->error;
                    return false;
                }
            }

            return json_encode(['message' => 'Success insert data !', 'data' => $data]);
        } else {
            echo 'Invalid JSON data.';
            return false;
        }

    }

    public function update($jsonData)
    {
        $data = json_decode($jsonData, true);

        if (is_array($data)) {
            foreach ($data as $row) {
                $id = $this->mysqli->real_escape_string($row['id']);
                $nama_lengkap = $this->mysqli->real_escape_string($row['nama_lengkap']);
                $jurusan = $this->mysqli->real_escape_string($row['jurusan']);
                $jenjang = $this->mysqli->real_escape_string($row['jenjang']);

                $search = $this->mysqli->query("SELECT * FROM mahasiswa WHERE id='$id'");

                if($search->num_rows < 1){
                    return json_encode(['message' => 'Data not found !', 'data' => $data]);
                }
                
                $query = "UPDATE mahasiswa SET nama_lengkap='$nama_lengkap', jurusan='$jurusan', jenjang='$jenjang' WHERE id='$id'";

                if (!$this->mysqli->query($query)) {
                    echo 'Error updating data: ' . $this->mysqli->error;
                    return false;
                }
            }

            return json_encode(['message' => 'Success insert data !', 'data' => $data]);
        } else {
            echo 'Invalid JSON data.';
            return false;
        }
    }

    public function delete($jsonData)
    {
        $data = json_decode($jsonData, true);

        if (is_array($data)) {
            foreach ($data as $row) {
                $id = $this->mysqli->real_escape_string($row['id']);
                $search = $this->mysqli->query("SELECT * FROM mahasiswa WHERE id='$id'");

                if($search->num_rows < 1){
                    return json_encode(['message' => 'Data not found !', 'data' => $data]);
                }

                $query = "DELETE FROM mahasiswa WHERE id='$id'";

                if (!$this->mysqli->query($query)) {
                    return json_encode(['message' => $this->mysqli->error]);
                }
            }

            return json_encode(['message' => 'Success delete data !', 'data' => $data]);
        } else {
            return json_encode(['message' => 'Failed delete data !', 'data' => $data]);
        }
    }
    
}

?>
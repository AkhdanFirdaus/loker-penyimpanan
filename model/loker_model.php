<?php

include_once 'koneksi.php';

class LokerModel
{
    private Database $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function readLoker()
    {
        $connection = $this->db->connectMysql();
        $query = "SELECT * FROM loker ORDER BY id_loker ASC";
        $hasil = mysqli_query($connection, $query);

        $data = [];
        while ($row = mysqli_fetch_array($hasil)) {
            $data[] = $row;
        }
        return $data;
    }

    function insertLoker($nama, $kapasitas)
    {
        $connection = $this->db->connectMysql();
        $query = "INSERT INTO loker (nama_loker, kapasitas_loker) VALUES ('$nama', $kapasitas)";
        $hasil = mysqli_query($connection, $query);
        if ($hasil) {
            $message = "Berhasil menyimpan loker";
            echo "<meta http-equiv='refresh' content='0; url=" . $_SERVER['PHP_SELF'] . '?message=' . $message .  "'>";
        } else {
            $message = "Gagal menambahkan loker";
            echo "<meta http-equiv='refresh' content='0; url=" . $_SERVER['PHP_SELF'] . '?errormessage=' . $message .  "'>";
        }
    }

    function deleteLoker($id)
    {
        $connection = $this->db->connectMysql();
        $query = "DELETE FROM loker WHERE id_loker=$id";
        $hasil = mysqli_query($connection, $query);
        if ($hasil) {
            $message = "Berhasil menghapus loker dengan id=$id";
            echo "<meta http-equiv='refresh' content='0; url=" . "index.php?message=" . $message .  "'>";
        } else {
            $message = "Gagal menghapus loker";
            echo "<meta http-equiv='refresh' content='0; url=" . $_SERVER['PHP_SELF'] . $_SERVER['REQUEST_URI'] . '&errormessage=' . $message .  "'>";
        }
    }

    function showLoker($id)
    {
        $connection = $this->db->connectMysql();
        $query = "SELECT * FROM loker WHERE id_loker = '$id'";
        $hasil = mysqli_query($connection, $query);
        $data = mysqli_fetch_array($hasil);
        return $data;
    }

    function updateLoker($id, $nama, $kapasitas)
    {
        $connection = $this->db->connectMysql();
        $query = "UPDATE loker SET nama_loker='$nama', kapasitas_loker=$kapasitas WHERE id_loker=$id";
        $hasil = mysqli_query($connection, $query);
        if ($hasil) {
            $message = "Berhasil mengupdate loker";
            echo "<meta http-equiv='refresh' content='0; url=" . $_SERVER['PHP_SELF'] . "?tipe=edit_loker&id_loker=$id&nama_loker=$nama&kapasitas_loker=$kapasitas&message=$message'>";
        } else {
            $message = "Gagal mengupdate loker";
            echo "<meta http-equiv='refresh' content='0; url=" . $_SERVER['PHP_SELF'] . $_SERVER['REQUEST_URI'] . '&errormessage=' . $message .  "'>";
        }
    }
}

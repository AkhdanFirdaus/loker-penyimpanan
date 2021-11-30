<?php

include_once 'koneksi.php';

class BarangModel
{
    private Database $db;
    private $idLoker;

    function __construct($idLoker)
    {
        $this->db = new Database();
        $this->idLoker = $idLoker;
    }

    function readBarang()
    {
        $connection = $this->db->connectMysql();
        $query = "SELECT * FROM barang WHERE barang.id_loker=$this->idLoker";
        $hasil = mysqli_query($connection, $query);

        $data = [];
        while ($row = mysqli_fetch_array($hasil)) {
            $data[] = $row;
        }
        return $data;
    }

    function insertBarang($nama, $qty)
    {
        $connection = $this->db->connectMysql();
        $query = "INSERT INTO barang (id_loker, nama_barang, qty_barang) VALUES ($this->idLoker, '$nama', $qty)";
        $hasil = mysqli_query($connection, $query);
        if ($hasil) {
            $message = "Berhasil menyimpan barang";
            echo "<meta http-equiv='refresh' content='0; url=" . $_SERVER['PHP_SELF'] . '?id=' . $this->idLoker . '&message=' . $message .  "'>";
        } else {
            $message = "Gagal menambahkan barang";
            echo "<meta http-equiv='refresh' content='0; url=" . $_SERVER['PHP_SELF'] . '?id=' . $this->idLoker . '&errormessage=' . $message .  "'>";
        }
    }

    function deleteBarang($id)
    {
        $connection = $this->db->connectMysql();
        $query = "DELETE FROM barang WHERE id_barang=$id";
        $hasil = mysqli_query($connection, $query);
        if ($hasil) {
            $message = "Barang dengan ID $id sudah dihapus";
            echo "<meta http-equiv='refresh' content='0; url=" . $_SERVER['PHP_SELF'] . '?id=' . $this->idLoker . '&message=' . $message .  "'>";
        } else {
            $message = "Gagal menghapus barang";
            echo "<meta http-equiv='refresh' content='0; url=" . $_SERVER['PHP_SELF'] . '?id=' . $this->idLoker . '&errormessage=' . $message .  "'>";
        }
    }

    function showBarang($id)
    {
        $connection = $this->db->connectMysql();
        $query = "SELECT * FROM barang WHERE barang.id_loker=$this->idLoker AND barang.id_barang=$id";
        $hasil = mysqli_query($connection, $query);
        $data = mysqli_fetch_array($hasil);
        return $data;
    }

    function updateBarang($id, $nama, $qty)
    {
        $connection = $this->db->connectMysql();
        $query = "UPDATE barang SET nama_barang='$nama', qty_barang=$qty WHERE id_barang=$id";
        $hasil = mysqli_query($connection, $query);
        if ($hasil) {
            $message = "Barang dengan ID $id sudah diupdate";
            echo "<meta http-equiv='refresh' content='0; url=" . $_SERVER['PHP_SELF'] . '?id=' . $this->idLoker . '&message=' . $message .  "'>";
        } else {
            $message = "Gagal mengupdate barang";
            echo "<meta http-equiv='refresh' content='0; url=" . $_SERVER['PHP_SELF'] . '?id=' . $this->idLoker . '&errormessage=' . $message .  "'>";
        }
    }
}

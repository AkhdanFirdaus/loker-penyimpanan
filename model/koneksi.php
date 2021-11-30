<?php
class Database
{
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPassword = "";
    private $dbName = "loker";

    function connectMysql()
    {
        $connection = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName) or die("Database tidak ada!");
        return $connection;
    }
}

<?php
$host     = "localhost";
$user     = "root";
$pass     = "";
$db       = "web2";

$koneksi  = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Gagal Conncet");
}

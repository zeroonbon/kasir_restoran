<?php
$hostname ="localhost";
$username ="root";
$password ="";
$database ="kasir_restoran";
// membuat koneksi ke database

$connect = mysqli_connect($hostname, $username, $password, $database);

// memeriksa apakah koneksi berhasil
if (!$connect) {
die("Koneksi gagal:". mysql_connect_error());
}

?>
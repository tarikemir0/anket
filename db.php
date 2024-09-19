<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oylama";

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

?>
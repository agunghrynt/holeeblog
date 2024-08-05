<?php
$servername = "127.0.0.1";
$username = "holee_sheet";
$password = "mindLess13@#";
$dbname = "holee_sheetblog";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$conn->close();
?>

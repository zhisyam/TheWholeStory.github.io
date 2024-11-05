<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "thewholestory_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$conn->close();
?>

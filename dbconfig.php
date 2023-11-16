<?php
$host = "localhost"; 
$database = "gwsc5";
$user = "root"; 
$password = "db5466"; 

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

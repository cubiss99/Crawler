<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "crawlerfix";
$conn = mysqli_connect($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

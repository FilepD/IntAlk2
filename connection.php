<?php
$servername = "localhost";
$username = "ero056";
$password = "abc123";
$dbname = "keszletnyilvantartas";


// Create connection
//$conn = new mysqli($servername, $username, $password,$dbname);
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  error_log("Connection failed", 0);
}
//echo "connection succesful";
error_log("Connection succesful", 0);
?>
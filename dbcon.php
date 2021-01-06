<?php
$servername = "localhost";
$username = "u361983408_event";
//$username = "root";
//$password = "";
//$servername = "sql348.main-hosting.eu";
//$username = "u361983408_event";
$password = "Don@1234";
$dbname = "u361983408_event";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
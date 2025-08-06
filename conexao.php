<?php
$host = "localhost";
$username = "username";
$password = "password";
$banco = "spacefinder";

// Create connection
$conn = new mysqli($host, $username, $password,$banco);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
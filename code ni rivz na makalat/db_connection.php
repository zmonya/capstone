<?php
$servername = "localhost";
$username = "root"; // Change if different
$password = ""; // Change if different
$dbname = "document_archival";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

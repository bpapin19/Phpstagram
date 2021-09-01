<?php

// Set up DB Connection
$host = "localhost";
$username = "id16855063_bmpapin";
$password = "llIE[p+|D3!UBGOF";
$database = "id16855063_phpstagram";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_errorno) {
   array_push($errors, "connection failed: " . $conn->connect_error);
}

?>
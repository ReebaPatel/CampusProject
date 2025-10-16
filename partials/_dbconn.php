<?php
// Database connection for events
$servername = "localhost";
$username = "root";
$password = "";
$database = "events";

$conn_events = mysqli_connect($servername, $username, $password, $database);

if (!$conn_events) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
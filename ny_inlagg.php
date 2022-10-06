<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webbserverprogrammering";

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "INSERT INTO inlagg (id, skriven_av, kommentar, datum, trad_id) VALUES ($result->num_rows+1, '$skapad_av', '$inlagg', NOW(), )";
$result = $conn->query($sql);

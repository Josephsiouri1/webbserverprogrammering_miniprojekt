<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webbserverprogrammering";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM inlagg";
$result = $conn->query($sql);

$skapad_av = $_SESSION['anvandernamn'];
$inlagg = $POST['kommentar'];
$password = $POST['password'];
$trad_id = $_GET['trad_id'];

$sql = "INSERT INTO inlagg (id, skriven_av, kommentar, datum, trad_id) VALUES ($result->num_rows+1, '$skapad_av', '$inlagg', NOW(), $trad_id)";
$result = $conn->query($sql);

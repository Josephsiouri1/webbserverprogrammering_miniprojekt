<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webbserverprogrammering";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rubrik = $_POST["rubrik"];
$inlagg = $_POST["inlagg"];
$skapad_av = $_SESSION['anvandernamn'];

$sql_tradar = "SELECT * FROM tradar";
$result_tradar = $conn->query($sql_tradar);


$sql_inlagg = "SELECT * FROM inlagg";
$result_inlagg = $conn->query($sql_inlagg);

if ($rubrik && $inlagg) {
    $sql = "INSERT INTO tradar (id, rubrik, skapad_av, senaste_inlagg) VALUES ($result_tradar->num_rows+1, '$rubrik', '$skapad_av', NOW())";
    $result = $conn->query($sql);
    $sql = "INSERT INTO inlagg (id, skriven_av, kommentar, datum, trad_id) VALUES ($result_inlagg->num_rows+1, '$skapad_av', '$inlagg', NOW(), $result_tradar->num_rows)";
    $result = $conn->query($sql);
    header('Location: ' . './bekraftat_inlagg.php');
} else {
    header('Location: ' . './fel_med_inlagg.php');
}
$conn->close();

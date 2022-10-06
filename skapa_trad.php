<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webbserverprogrammering";

$conn = new mysqli($servername, $username, $password, $dbname);


$rubrik = $_POST["rubrik"];
$inlagg = $_POST["inlagg"];
$skapad_av = $_SESSION['anvandernamn'];


$sql_tradar = "SELECT * FROM tradar";
$result = $conn->query($sql_tradar);

if ($rubrik && $inlagg) {
    $sql = "INSERT INTO tradar (id, rubrik, skapad_av, senaste_inlagg) VALUES ($result->num_rows, '$rubrik', '$skapad_av', NOW())";
    $result = $conn->query($sql);
    header('Location: ' . './bekraftat_inlagg.php');
} else {
    header('Location: ' . './fel_med_inlagg.php');
}

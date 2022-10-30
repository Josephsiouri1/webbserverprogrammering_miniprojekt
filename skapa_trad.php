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
    $sql = $conn->prepare("INSERT INTO tradar (id,rubrik,skapad_av, senaste_inlagg) VALUES ($result_tradar->num_rows + 1, ?, ?, NOW())");
    $sql->bind_param('ss', $rubrik, $skapad_av);
    $sql->execute();
    $sql = $conn->prepare("INSERT INTO inlagg (id,skriven_av,kommentar, datum, trad_id) VALUES ($result_inlagg->num_rows+1, ?, ?,NOW(), $result_tradar->num_rows+1)");
    $sql->bind_param('ss', $skapad_av, $inlagg);
    $sql->execute();
    header('Location: ' . './bekraftat_inlagg.php');
} else {
    header('Location: ' . './fel_med_inlagg.php');
}
$conn->close();

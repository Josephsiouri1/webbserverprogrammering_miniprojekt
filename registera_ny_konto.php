<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webbserverprogrammering";

$conn = new mysqli($servername, $username, $password, $dbname);


$ny_anvandernamn = $_POST['ny_anvandernamn'];
$ny_losenord = $_POST['ny_losenord'];

$sql = "SELECT * FROM users";
$result_users = $conn->query($sql);

function duplicate_account($result_users, $ny_anvandernamn, $ny_losenord)
{
    while ($row = $result_users->fetch_assoc()) {
        if ($ny_anvandernamn == $row['anvandernamn'] && $ny_losenord == $row['losenord']) {
            return true;
        }
    }
}
if (!duplicate_account($result_users, $ny_anvandernamn, $ny_losenord)) {

    if ($ny_anvandernamn && $ny_losenord) {
        $sql = "INSERT INTO users (id, username, password) VALUES ($result_users->num_rows+1, '$ny_anvandernamn', '$ny_losenord');";
        $result = $conn->query($sql);
        echo "Ny konto skapades!";
        echo "<form action='inloggning.php'>
        <input type='submit' value='Gå tillbaka till inloggningssida'>
    </form>";
    } else {
        header('Location: ' . './skapa_ny_konto.php');
    }
} else {
    header('Location: ' . './skapa_ny_konto.php');
}
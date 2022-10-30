<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webbserverprogrammering";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$ny_anvandernamn = $_POST['ny_anvandernamn'];
$ny_losenord = $_POST['ny_losenord'];

$sql = "SELECT * FROM users";
$result_users = $conn->query($sql);

function duplicate_account($result_users, $ny_anvandernamn, $ny_losenord)
{
    while ($row = $result_users->fetch_assoc()) {
        if ($ny_anvandernamn == $row['username'] && $ny_losenord == $row['password']) {
            return true;
        }
    }
}
if (!duplicate_account($result_users, $ny_anvandernamn, $ny_losenord)) {

    if ($ny_anvandernamn && $ny_losenord) {

        $sql = $conn->prepare("INSERT INTO users (id,username,password) VALUES ($result_users->num_rows+1, ?, ?)");
        $sql->bind_param('ss', $ny_anvandernamn, $ny_losenord);
        $sql->execute();

        echo "Ny konto skapades!";
        echo "<form action='inloggning.php'>
        <input type='submit' value='Tillbaka till inloggningssida'>
    </form>";
    } else {
        echo "Data sakanas. Va snäll och fyll i alla rutor.";
        echo "<form action='skapa_ny_konto.php'>
        <input type='submit' value='Försök igen'>
    </form>";
    }
} else {
    echo "Konton du skrev är redan skapat!";
    echo "<form action='skapa_ny_konto.php'>
        <input type='submit' value='Försök igen'>
    </form>";
}
$conn->close();

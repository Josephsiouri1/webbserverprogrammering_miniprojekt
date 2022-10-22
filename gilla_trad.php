<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gillat tråd</title>
</head>

<body>
    <form action="ater_inloggning.php" method="post">
        Användernamn: &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&nbsp;&nbsp;<input type="text" name="anvandernamn"> <br>
        Lösenord för användaren: <input type="password" name="losenord"> <br>
        <input type="submit" value="Logga in"> <br> <br>
    </form>
    <form action="loggaut.php">
        <input type="submit" value="Logga ut"> <br> <br>
    </form>
    <form action="skapa_ny_konto.php">
        <input type="submit" value="Skapa ny konto">
    </form>
    <hr>

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
    $trad_id = $_GET['trad_id'];
    $anvandernamn = $_SESSION['anvandernamn'];

    $sql_gilla = "SELECT * FROM gilla_tradar";
    $result_gilla = $conn->query($sql_gilla);

    $redan_gillat = false;

    if ($result_gilla->num_rows > 0) {
        echo "<ol>";
        while ($row = $result_gilla->fetch_assoc()) {
            if ($row['anvandernamn'] == $anvandernamn) {
                if ($row['trad_id'] == $trad_id) {
                    $redan_gillat = true;
                }
            }
        }
    }

    if (!$redan_gillat) {
        $sql = "INSERT INTO gilla_tradar (trad_id,anvandernamn) VALUES ($trad_id,'$anvandernamn')";
        $result = $conn->query($sql);
        echo "Du har gillat tråden med id: $trad_id";
    } else {
        echo "Du har redan gillat denna tråd.";
    }
    echo "<form action='tradar.php' method='post'>
    <input type='submit' value='Tillbaka till startsidan'>
     </form> <br>";
    $conn->close();
    ?>
</body>

</html>
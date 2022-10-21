<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ta bort tråd</title>
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

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webbserverprogrammering";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $id =  $_GET['id'];
    $skapad_av =  $_GET['skapad_av'];
    $inloggning =  $_GET['inloggning'];

    if ($skapad_av == $inloggning) {
        $sql = "DELETE FROM tradar WHERE id=$id";
        $result = $conn->query($sql);
        echo "Tråden med id: " . $_GET['id'] . " togs bort.<br><br>";
    } else {
        echo "Du kan inte ta bort andras inlägg.<br><br>";
    }

    echo "<form action='tradar.php' method='post'>
    <input type='submit' value='Tillbaka till startsidan'>
     </form>";
    $conn->close();
    ?>
</body>

</html>
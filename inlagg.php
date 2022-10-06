<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inlägg</title>
</head>

<body>
    <form action="tradar.php" method="post">
        Användernamn: &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&nbsp;&nbsp;<input type="text" name="anvandernamn"> <br>
        Lösenord för användaren: <input type="password" name="losenord"> <br>
        <input type="submit" value="Logga in"> <br> <br>
    </form>
    <form action="loggaut.php">
        <input type="submit" value="Logga ut">
    </form>
    <hr>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webbserverprogrammering";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT rubrik FROM tradar WHERE id=" . $_GET['id'];
    $result = $conn->query($sql);

    echo "Inloggad som " . "<a href='mailto:" . $_SESSION['anvandernamn'] . "?subject='HTML link''>" . $_SESSION['anvandernamn'] . "</a>";
    echo "<form action='tradar.php' method='post'>
    <input type='submit' value='Tillbaka till startsidan'>
     </form> <br>";

    while ($row = $result->fetch_assoc()) {
        echo "<h1>" . $row['rubrik'] . "</h1>";
        $rubrik = $row['rubrik'];
    }

    $sql = "SELECT * FROM inlagg";
    $result = $conn->query($sql);

    echo "Det finns " . $result->num_rows . " inlägg i denna tråd: <br>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Skrivet av " . $row['skriven_av'] . "<span class='kommentar'>" . $row['kommentar'] . "</span> <br>" . $row['datum'];
        }
    }

    $sql = "INSERT INTO inlagg (id, skriven_av, kommentar, datum, trad_id) VALUES ($result->num_rows+1, '$skapad_av', '$inlagg', NOW(), )";
    $result = $conn->query($sql);

    ?>
</body>

</html>
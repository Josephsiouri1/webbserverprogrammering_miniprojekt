<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inlägg</title>
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
    $sql = "SELECT rubrik FROM tradar WHERE id=" . $_GET['id'];
    $result = $conn->query($sql);

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    echo "Inloggad som " . "<a href='mailto:" . test_input($_SESSION['anvandernamn']) . "?subject='HTML link''>" . test_input($_SESSION['anvandernamn']) . "</a>";
    echo "<form action='tradar.php' method='post'>
    <input type='submit' value='Tillbaka till startsidan'>
     </form> <br>";

    while ($row = $result->fetch_assoc()) {
        echo "<h1>" . $row['rubrik'] . "</h1>";
        $rubrik = $row['rubrik'];
    }

    $sql = "SELECT * FROM inlagg WHERE trad_id = " . $_GET['id'];
    $result = $conn->query($sql);

    echo "Det finns " . $result->num_rows . " inlägg i denna tråd: <br> <br>";

    function random_color()
    {
        $array_colors = array("lightblue", "#E74892", "lightgreen", "#DB99E0", "orange");
        $array_index = array_rand($array_colors);
        return $array_colors[$array_index];
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sql_like_number = "SELECT * FROM gilla_inlagg WHERE inlagg_id=" . $row['id'];
            $result_antal = $conn->query($sql_like_number);
            echo "<p style='background-color:" . random_color() . "';>Skrivet av " . "<a href='mailto:" . $row['skriven_av'] . "?subject='HTML link''>" . $row['skriven_av'] . "</a>" . "<br><span class='kommentar'>Inlägg: " . test_input($row['kommentar']) . "</span> <br>" . $row['datum'] . " </p><form action='gilla_inlagg.php?inlagg_id=" . $row['id'] . "' method='post'><input type='submit' value='Gilla'></form>" . "<span>Antal gillar:</span>" . "  " . $result_antal->num_rows . "<hr> <br> <br>";
        }
    }
    echo "Svara på denna tråd: <br>
    <form action='ny_inlagg.php?trad_id=" . $_GET['id'] . "' method='post'>
    <textarea name='kommentar' rows='4' cols='50'></textarea> <br>
    Lösenordet till epostkontot: <br>
    <input type='password' name='check_password'> <br>
    <input type='submit' value='Publicera'>
   </form>";
    $conn->close();

    ?>

</body>

</html>
<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inläggen</title>
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
    $redan_inloggad = $_SESSION['anvandernamn'];

    if (!$redan_inloggad) {
        $anvandernamn = $_POST['anvandernamn'];
        $losenord = $_POST['losenord'];

        if ($anvandernamn == "jos" && $losenord == "sio" || $anvandernamn == "deo" && $losenord == "leo" || $anvandernamn == "ulf" && $losenord == "rulf") {
            echo "Välkommen <a href='mailto:$anvandernamn?subject='HTML link''>$anvandernamn</a>";

            $_SESSION['anvandernamn'] = $anvandernamn;

            echo "<form action='nytrad.php' method='post'>
            <input type='submit' value='Skapa ny tråd'>
        </form> <br>";

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "webbserverprogrammering";

            $conn = new mysqli($servername, $username, $password, $dbname);

            $sql = "SELECT * FROM tradar";
            $result = $conn->query($sql);


            echo "Det finns $result->num_rows trådar: <br> <br>";

            echo "<div class='titles'>";
            echo "<span><b> Nr </b></span>";
            echo "<span><b> Inläggen</b></span>";
            echo "<span><b> Rubrik</b></span>";
            echo "<span><b> Skapad av</b></span>";
            echo "<span><b> Senaste inlägg</b></span>";
            echo "</div>";

            if ($result->num_rows > 0) {
                echo "<ol>";
                while ($row = $result->fetch_assoc()) {
                    echo " <li class='list-item'> <form class='form' action='inlagg.php?id=" . $row['id'] . "'" . "method='post'>
                <input class='las' type='submit' value='läs'>
                </form>" . "<span>" .  $row['rubrik'] . "</span>" . "<span>" . "<a href='mailto:" . $row['skapad_av'] . "?subject='HTML link''>" . $row['skapad_av'] . "</a>" . "</span> " . "<span>" . $row['senaste_inlagg'] . "</span>" . "<li>";
                }
            }
            echo "</ol>";
        }
    } else if ($redan_inloggad) {
        echo "Välkommen <a href='mailto:$redan_inloggad?subject='HTML link''>$redan_inloggad</a>";

        echo "<form action='nytrad.php' method='post'>
            <input type='submit' value='Skapa ny tråd'>
        </form> <br>";

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "webbserverprogrammering";

        $conn = new mysqli($servername, $username, $password, $dbname);

        $sql = "SELECT * FROM tradar";
        $result = $conn->query($sql);


        echo "Det finns $result->num_rows trådar: <br> <br>";

        echo "<div class='titles'>";
        echo "<span><b> Nr </b></span>";
        echo "<span><b> Inläggen</b></span>";
        echo "<span><b> Rubrik</b></span>";
        echo "<span><b> Skapad av</b></span>";
        echo "<span><b> Senaste inlägg</b></span>";
        echo "</div>";

        if ($result->num_rows > 0) {
            echo "<ol>";
            while ($row = $result->fetch_assoc()) {
                echo " <li class='list-item'> <form class='form' action='inlagg.php?id=" . $row['id'] . "'" . "method='post'>
                <input class='las' type='submit' value='läs'>
                </form>" . "<span>" .  $row['rubrik'] . "</span>" . "<span>" . "<a href='mailto:" . $row['skapad_av'] . "?subject='HTML link''>" . $row['skapad_av'] . "</a>" . "</span> " . "<span>" . $row['senaste_inlagg'] . "</span>" . "<li>";
            }
        }
        echo "</ol>";
    } else {
        echo "Login misslyckades!";
    }

    ?>
</body>

</html>
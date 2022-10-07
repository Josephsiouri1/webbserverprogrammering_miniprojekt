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
        <input type="submit" value="Logga ut"> <br> <br>
    </form>
    <form action="skapa_ny_konto.php">
        <input type="submit" value="Skapa ny konto">
    </form>
    <hr>
    <?php
    session_start();

    if (!isset($_SESSION["anvandernamn"])) {
        $anvandernamn = $_POST['anvandernamn'];
        $losenord = $_POST['losenord'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "webbserverprogrammering";

        $conn = new mysqli($servername, $username, $password, $dbname);

        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        $account_check = array();
        //problem med återinloggning
        while ($row = $result->fetch_assoc()) {
            if ($anvandernamn == $row['username'] && $losenord == $row['password']) {
                echo "Välkommen <a href='mailto:$anvandernamn?subject='HTML link''>$anvandernamn</a>";

                $_SESSION['anvandernamn'] = $anvandernamn;
                $_SESSION['losenord'] = $losenord;
                echo "<form action='nytrad.php' method='post'>
                <input type='submit' value='Skapa ny tråd'>
                </form> <br>";

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
                        echo " <li class='list-item'>" . "<span>" . $row['id'] . "</span>" . "<form class='form' action='inlagg.php?id=" . $row['id'] . "'" . "method='post'>
                    <input class='las' type='submit' value='läs'>
                    </form>" . "<span>" .  $row['rubrik'] . "</span>" . "<span>" . "<a href='mailto:" . $row['skapad_av'] . "?subject='HTML link''>" . $row['skapad_av'] . "</a>" . "</span> " . "<span>" . $row['senaste_inlagg'] . "</span>" . "</li>";
                    }
                }
                echo "</ol>";
                array_push($account_check, false);
            } else {
                array_push($account_check, true);
            }
        }
        if (!in_array(false, $account_check)) { //om det är en konto som matchar så körs inte den if-satsen
            echo "Login misslyckades";
        }
    } else if (isset($_SESSION["anvandernamn"])) {
        echo "Välkommen <a href='mailto:" . $_SESSION["anvandernamn"] . "?subject='HTML link''>" . $_SESSION["anvandernamn"] . "</a>";

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
                echo " <li class='list-item'>" . "<span>" . $row['id'] . "</span>" . "<form class='form' action='inlagg.php?id=" . $row['id'] . "'" . "method='post'>
                <input class='las' type='submit' value='läs'>
                </form>" . "<span>" .  $row['rubrik'] . "</span>" . "<span>" . "<a href='mailto:" . $row['skapad_av'] . "?subject='HTML link''>" . $row['skapad_av'] . "</a>" . "</span> " . "<span>" . $row['senaste_inlagg'] . "</span>" . "</li>";
            }
        }
        echo "</ol>";
    }

    ?>
</body>

</html>
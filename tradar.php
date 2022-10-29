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
    <?php error_reporting(E_ALL ^ E_NOTICE); ?>
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
    $sql = "SELECT * FROM users";
    $result_tradar = $conn->query($sql);

    $account_check = array();
    if (!isset($_SESSION["anvandernamn"])) {
        $anvandernamn = $_POST['anvandernamn'];
        $losenord = $_POST['losenord'];
    } else {
        $anvandernamn = $_SESSION['anvandernamn'];
        $losenord = $_SESSION['losenord'];
    }
    while ($row = $result_tradar->fetch_assoc()) {
        if ($anvandernamn == $row['username'] && $losenord == $row['password']) {
            echo "Välkommen <a href='mailto:$anvandernamn?subject='HTML link''>$anvandernamn</a>";

            $_SESSION['anvandernamn'] = $anvandernamn;
            $_SESSION['losenord'] = $losenord;
            echo "<form action='nytrad.php' method='post'>
            <input type='submit' value='Skapa ny tråd'>
            </form> <br>";

            $sql_tradar = "SELECT * FROM tradar";
            $result_tradar = $conn->query($sql_tradar);


            echo "Det finns $result_tradar->num_rows trådar: <br> <br>";

            echo "<div class='titles'>";
            echo "<span><b> Nr </b></span>";
            echo "<span><b> Inläggen</b></span>";
            echo "<span><b> Rubrik</b></span>";
            echo "<span><b> Skapad av</b></span>";
            echo "<span><b> Senaste inlägg</b></span>";
            echo "<span><b> Gilla</b></span>";
            echo "</div>";




            if ($result_tradar->num_rows > 0) {
                echo "<ol>";
                while ($row = $result_tradar->fetch_assoc()) {
                    $sql_like_number = "SELECT * FROM gilla_tradar WHERE trad_id=" . $row['id'];
                    $result_antal = $conn->query($sql_like_number);
                    echo " <li class='list-item'>" . "<span>" . $row['id'] . "</span>" . "<form class='form' action='inlagg.php?id=" . $row['id'] . "'" . "method='post'>
                <input class='las' type='submit' value='läs'>
                </form>" . "<span>" .  $row['rubrik'] . "</span>" . "<span>" . "<a href='mailto:" . $row['skapad_av'] . "?subject='HTML link''>" . $row['skapad_av'] . "</a>" . "</span> " . "<span>" . $row['senaste_inlagg'] . "</span>" . "<form action='gilla_trad.php?trad_id=" . $row['id'] . "' method='post'><input type='submit' value='Gilla'></form>" .  $result_antal->num_rows . "</li>";
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

    $conn->close();
    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ny_inlagg</title>
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
    session_start();

    echo "Inloggad som " . "<a href='mailto:" . $_SESSION['anvandernamn'] . "?subject='HTML link''>" . $_SESSION['anvandernamn'] . "</a>";
    echo "<form action='tradar.php' method='post'>
    <input type='submit' value='Tillbaka till startsidan'>
     </form> <br>";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webbserverprogrammering";

    $conn = new mysqli($servername, $username, $password, $dbname); //or die???

    $sql = "SELECT * FROM inlagg";
    $result = $conn->query($sql);

    $skapad_av = $_SESSION['anvandernamn'];
    $inlagg = $_POST['kommentar'];
    $check_password = $_POST['check_password'];
    $trad_id = $_GET['trad_id'];

    if ($inlagg && $check_password == $_SESSION['losenord']) {
        $sql = "INSERT INTO inlagg (id, skriven_av, kommentar, datum, trad_id) VALUES ($result->num_rows+1, '$skapad_av', '$inlagg', NOW(), $trad_id)";
        $result = $conn->query($sql);

        $sql = "UPDATE tradar SET senaste_inlagg = NOW() WHERE id=$trad_id";
        $result = $conn->query($sql);

        echo "Kommentaren har sparats.";
    } else {
        echo "Ogiligt inmatning";
        echo "<form action='inlagg.php?id=$trad_id'method='post'>
        <input type='submit' value='Försök igen'>
        </form> <br>";
    }
    ?>
</body>

</html>
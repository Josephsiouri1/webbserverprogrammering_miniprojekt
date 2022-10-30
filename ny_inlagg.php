<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ny_inlagg</title>
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

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webbserverprogrammering";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM inlagg";
    $result = $conn->query($sql);

    $skapad_av = $_SESSION['anvandernamn'];
    $inlagg = $_POST['kommentar'];
    $check_password = $_POST['check_password'];
    $trad_id = $_GET['trad_id'];

    if ($inlagg && $check_password == $_SESSION['losenord']) {

        $sql = $conn->prepare("INSERT INTO inlagg (id,skriven_av,kommentar, datum, trad_id) VALUES ($result->num_rows+1, ?, ?,NOW(), $trad_id)");
        $sql->bind_param('ss', $skapad_av, $inlagg);
        $sql->execute();

        $sql = "UPDATE tradar SET senaste_inlagg = NOW() WHERE id=$trad_id";
        $result = $conn->query($sql);

        echo "Kommentaren har sparats.";
    } else {
        echo "Ogiligt inmatning";
        echo "<form action='inlagg.php?id=$trad_id'method='post'>
        <input type='submit' value='Försök igen'>
        </form> <br>";
    }
    $conn->close();
    ?>
</body>

</html>
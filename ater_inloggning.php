
    <?php
    session_start();
    session_destroy(); //den tar bort den gamla session och startar ett nytt.
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webbserverprogrammering";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $anvandernamn = $_POST['anvandernamn'];
    $losenord = $_POST['losenord'];

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    $_SESSION['anvandernamn'] = $anvandernamn;
    $_SESSION['losenord'] = $losenord;

    $conn->close();

    header('Location: ' . './tradar.php');

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>åter inloggning</title>
</head>

<body>

    <?php
    session_start();
    session_destroy();
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webbserverprogrammering";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $anvandernamn = $_POST['anvandernamn'];
    $losenord = $_POST['losenord'];

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    $account_check = array();

    $_SESSION['anvandernamn'] = $anvandernamn;
    $_SESSION['losenord'] = $losenord;


    header('Location: ' . './tradar.php');
    ?>

</body>

</html>
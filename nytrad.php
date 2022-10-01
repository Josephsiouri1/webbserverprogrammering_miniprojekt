<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ny tråd</title>
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
    echo "Inloggad som " . "<a href='mailto:" . $_SESSION['anvandernamn'] . "?subject='HTML link''>" . $_SESSION['anvandernamn'] . "</a>";
    echo "<form action='tradar.php' method='post'>
    <input type='submit' value='Tillbaka till startsidan'>
     </form> <br>"
    ?>
    <h1>Ny tråd</h1>
    <br>
    <form action="skapa_trad.php" method="post">
        Rubrik <br>
        <input type="text" name="rubrik"> <br>
        Inlägg <br>
        <textarea name="inlagg" rows="4" cols="50"></textarea> <br>
        <input type="submit" value="Publicera">
    </form>

    <span>Meddela mig via email vid nya inlägg: </span> <input type="checkbox" name="checkbox"> <br>


</body>

</html>
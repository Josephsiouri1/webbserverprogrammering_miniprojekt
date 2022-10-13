<?php
session_start();
session_destroy();
session_start();

$anvandernamn = $_POST['anvandernamn'];
$losenord = $_POST['losenord'];

$_SESSION['anvandernamn'] = $anvandernamn;
$_SESSION['losenord'] = $losenord;

header('Location: ' . './tradar.php');

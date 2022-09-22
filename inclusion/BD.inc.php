<?php
    $mysqli = new mysqli('localhost', 'sakha', 'traore', 'BDD_Commerce');
    if($mysqli->connect_errno) die('Un probleme est survenu lors de la tentative de connexion a la BDD :' .$mysqli->connect_errno);

    session_start();

    define("RACINE_SITE","/E-Commerce/");

    $contenu = '';

    require_once('fonction.inc.php');
?>
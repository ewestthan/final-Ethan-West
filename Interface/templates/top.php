<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale = 1.0">
        <meta name="author" content="Nicholas Gibson | Ethan West">
        <meta name="description"
            content="">
        <title>Eric Jerome's Top 100</title>
        <link rel="shortcut icon" type="image/jpg" href="../images/logo.png"/>
        <link rel="stylesheet" 
              href="../style/style.css?version=<?php print time();?>"
              type="text/css">
        <script src="../static/modal.js"></script>
        <script src="../static/sortTable.js"></script>
        <script src="../static/updateForm.js"></script>
        <script src="../static/tableTabs.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <?php
    include "../lib/constants.php";
    if (DEVELOPMENT || DEBUG) {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
    require_once("../lib/database.php");
    require('../lib/passwords.php');
    $thisDatabaseWriter = new DataBase($dbUsername, 'w', $dbName);
    require_once("../lib/functions.php");
    print'<body class="' . PATH_PARTS['filename'] . '">' . PHP_EOL;
    print'<!-- ***** START OF BODY ***** -->';
    print PHP_EOL;
    include 'header.php';
    print PHP_EOL;
    include 'nav.php';
    print PHP_EOL;
    ?>
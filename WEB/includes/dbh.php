<?php
    // Date : 05 march 2021
    // This is the Mysql Database Handling File

    // Basic Credentials for the database access
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "horizonsp1";

    // connection variable for the database
    $conn = mysqli_connect($serverName, $userName, $password, $dbName);

    
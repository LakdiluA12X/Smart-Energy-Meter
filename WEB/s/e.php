<?php

// Date: 05 march 2021
// This is the script for extract data and update to the data base from the unit

// incluse database handler
include_once '../includes/dbh.php';

$IDN = $_GET['i'];

// search the data base to authenticate the user
$sql_querry = "SELECT * FROM `users` WHERE `idn`= '$IDN'";
$result = mysqli_query($conn, $sql_querry);
$result_check = mysqli_num_rows($result);

// if user in the data base
if ($result_check > 0){
    //read user data
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];

    //read consumption from get data
    $consumption = $_GET['c'];
    $date = $_GET['d'];

    //insert data to the database
    $sql_querry = "INSERT INTO `consumption`(`id`, `date`, `consumption`) VALUES ($id, $date, $consumption)";
    mysqli_query($conn, $sql_querry);

    echo $consumption;
}//end of result check if statement

else{
    echo "You are not in the data base";
    echo "Your identity address is ".$IDN;
}

?>
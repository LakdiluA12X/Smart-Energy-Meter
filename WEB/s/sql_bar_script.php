<?php

    header("Content-Type: application/json");

    include_once "..\includes\dbh.php";

    // $date_querry = '202203%%';
    $date_querry = date('Ym')."%%";
    $user_id = 20031033;

    $sql = "SELECT * FROM `consumption` WHERE `date` LIKE ? AND `id` = ?";
    $stmt = mysqli_stmt_init($conn);
    
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "si", $date_querry, $user_id);
    mysqli_stmt_execute($stmt);
    
    $preresults = mysqli_stmt_get_result($stmt);

    $month_data = array();
    while($row = mysqli_fetch_assoc($preresults))
    {
        $row['date'] = substr_replace($row['date'], '-', 4, 0);
        $row['date'] = substr_replace($row['date'], '-', 7, 0);
        $month_data[] = $row;
    } 

    $preresults -> close();

    print json_encode($month_data);

?>
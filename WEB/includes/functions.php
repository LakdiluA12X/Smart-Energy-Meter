<?php

include_once "dbh.php";


function calcBill($id, $date_querry, $conn, $total_units = 0){

    $return_data = array(); // this will be returned

    if($total_units == 0){
        // First fetch consumption data from the table
        $sql = "SELECT * FROM `consumption` WHERE `date` LIKE ? AND `id` = ?";
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "si", $date_querry, $id);
        mysqli_stmt_execute($stmt);
        
        $preresults = mysqli_stmt_get_result($stmt);

        $consumption_data = array();

        while($row = mysqli_fetch_assoc($preresults))
        {
            array_push($consumption_data, $row['consumption']);
        }

        if($consumption_data){
            //Calculate the total, mean, std
            $total_units = array_sum($consumption_data);
            array_push($return_data, $total_units);

            $average_units = $total_units / count($consumption_data);
            array_push($return_data, $average_units);

            $variance = 0;
            foreach($consumption_data as $i){$variance += pow(($i - $average_units), 2);}

            $std_units = (float)sqrt($variance/count($consumption_data));
            array_push($return_data, $std_units);
        }// end of if statement
        else{
            array_push($return_data, 0);
            array_push($return_data, 0);
            array_push($return_data, 0);
        }


    }// end of if unit = 0?



    // calculate the price
    $sql = "SELECT * FROM `unitcalc`";
    $stmt = mysqli_stmt_init($conn);
    
    mysqli_stmt_prepare($stmt, $sql);
    // mysqli_stmt_bind_param($stmt, "si", $date_querry, $id);
    mysqli_stmt_execute($stmt);
    
    $preresults = mysqli_stmt_get_result($stmt);

    $price = 0;
    while($row = mysqli_fetch_assoc($preresults))
    {
        if ($total_units <= $row['unit_range']){
            $price += intval($total_units) * $row['charge']; // calculate the normal price
            $price += $row['fixed']; // adding the fixed price
            break;
        }else{
            $price += $row['unit_range'] * $row['charge'];
            $total_units -= $row['unit_range'];
        }

    }// end of while loop

    array_push($return_data, $price);

    return $return_data;
    
}// end of calcBIll function

?>
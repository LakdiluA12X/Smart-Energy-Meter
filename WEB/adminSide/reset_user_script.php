<?php
    include_once "..\includes\dbh.php";
    session_start();
 
    if (isset($_POST['reset_submit'])){  
        $name  = $_POST['name'];
        $nic   = $_POST['nic'];
        $id   = $_POST['id'];
        $idn   = $_POST['idn'];
        $home  = $_POST['home'];
        $road  = $_POST['road'];
        $city  = $_POST['city'];   

        // check for empty fields
        if (empty($nic) || empty($idn) || empty($name) || empty($home) || empty($road) || empty($city)){
            header('Location: reset_user.php?result=empty');
            exit();
        }
        // else go to update data
        else{
            $id   = $_POST['id'];


            $sql = "UPDATE `users` SET `nic`=?,`idn`=?,`name`=?,`passwd`=?,`home`=?,`road`=?,`city`=? WHERE `id`=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header('Location: reset_user.php?result=sql');
                exit();
            }else{

                function randomPassword() {
                    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^';
                    $pass = array(); //remember to declare $pass as an array
                    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                    for ($i = 0; $i < 8; $i++) {
                        $n = rand(0, $alphaLength);
                        $pass[] = $alphabet[$n];
                    }
                    return implode($pass); //turn the array into a string
                }
                $passwd = randomPassword();

                $hashed = password_hash($passwd, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, "sssssssi", $nic, $idn, $name, $hashed, $home, $road, $city, $id);
                mysqli_stmt_execute($stmt);
                
                header('Location: reset_user.php?result=success&pass='.$passwd);
                exit();
            }








        }// end of else statemnt

    }// end of main isset if statement
    else{
        header('Location: add_user.php');
        exit();
    }

?>
<?php
    include_once "..\includes\dbh.php";
    session_start();
 
    if (isset($_POST['login_submit'])){
        $name  = $_POST['name'];
        $nic   = $_POST['nic'];
        $id   = $_POST['id'];
        $idn   = $_POST['idn'];
        $uname = $_POST['uname'];
        $home  = $_POST['home'];
        $road  = $_POST['road'];
        $city  = $_POST['city'];
        
        // check for empty fields
        if (empty($id) || empty($name) || empty($nic) || empty($idn) || empty($uname) || empty($home) || empty($road) || empty($city)){
            header('Location: signin_page.php?result=empty');
            exit(); 
        }

        // else go to sign in
        else{

            //check if username is taken
            $sql = "SELECT id FROM users WHERE id=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header('Location: add_user.php?result=sql');
                exit();
            }else {
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);

                if ($resultCheck > 0){
                    header('Location: add_user.php?result=userext');
                    exit();
                }else{

                    $sql = "INSERT INTO `users`(`id`, `nic`, `idn`, `name`, `uname`, `passwd`, `home`, `road`, `city`, `till`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header('Location: add_user.php?result=sql');
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

                        mysqli_stmt_bind_param($stmt, "issssssssi", $id, $nic, $idn, $name, $uname, $hashed, $home, $road, $city, $_SESSION['id']);
                        mysqli_stmt_execute($stmt);
                        
                        header('Location: add_user.php?result=success&pass='.$passwd);
                        exit();
                    }
                }
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);

        }// end of else statemnt

    }// end of main isset if statement
    else{
        header('Location: add_user.php');
        exit();
    }

?>
<?php
    include_once "..\includes\dbh.php";
    
    if (isset($_POST['login_submit'])){
        $name     = $_POST['name'];
        $uname    = $_POST['uname'];
        $passwd   = $_POST['password'];
        $repasswd = $_POST['repassword'];
        
        // check for empty fields
        if (empty($name) || empty($uname) || empty($passwd) || empty($repasswd)){
            header('Location: signin_page.php?result=empty');
            exit(); 
        }

        //check for the valid email
        else if(!preg_match( "/^[a-zA-Z0-9]*$/" , $uname)){
            header('Location: signin_page.php?result=unamesy');
            exit();
        }

        // check passwords same
        else if ($passwd != $repasswd){
            header('Location: signin_page.php?result=passmatch');
            exit();
        }

        // else go to sign in
        else{

            //check if username is taken
            $sql = "SELECT uname FROM tills WHERE uname=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header('Location: signin_page.php?result=sql');
                exit();
            }else {
                mysqli_stmt_bind_param($stmt, "s", $uname);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);

                if ($resultCheck > 0){
                    header('Location: signin_page.php?result=unameext');
                    exit();
                }else{

                    $sql = "INSERT INTO tills(name, uname, passwd) VALUES(?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header('Location: signin_page.php?result=sql');
                        exit();
                    }else{

                        $hashed = password_hash($passwd, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, "sss", $name, $uname, $hashed);
                        mysqli_stmt_execute($stmt);
                        
                        header('Location: login_page.php');
                        exit();
                    }
                }
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);

        }// end of else statemnt

    }// end of main isset if statement
    else{
        header('Location: signin_page.php');
        exit();
    }

?>
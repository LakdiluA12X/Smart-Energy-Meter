<?php
    include_once "..\includes\dbh.php";
    
    if (isset($_POST['login_submit'])){
        $till_id = $_POST['tillid'];
        $passwd = $_POST['password'];

        // check for empty fields
        if (empty($till_id) || empty($passwd)){
            header('Location: signin_page.php?result=empty');
            exit(); 
        }

        //check for the valid email
        else if(!preg_match( "/^[a-zA-Z0-9]*$/" , $till_id)){
            header('Location: signin_page.php?result=unamesy');
            exit();
        }

        //connect to the sql database

        else{

            $sql = "SELECT * from tills WHERE uname = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header('Location: login_page.php?result=sql');
                exit();
            }else {
                mysqli_stmt_bind_param($stmt, "s", $till_id);
                mysqli_stmt_execute($stmt);     
                $result = mysqli_stmt_get_result($stmt);

                if($row = mysqli_fetch_assoc($result)){

                    $passwd_check = password_verify($passwd, $row['passwd']);

                    if($passwd_check == false){
                        header('Location: login_page.php?result=passwd');
                        exit();
                    }else if ($passwd_check == true){
                        session_start();
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['uname'] = $row['uname'];
                        $_SESSION['id'] = $row['id'];

                        header('Location: index.php');
                        exit();
                    }

                }else{
                    header('Location: login_page.php?result=nouser');
                    exit();
                }

            
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }

    }// end of main isset if statement
    else{
        header('Location: login_page.php');
        exit();
    }

?>
<?php
    include_once "..\includes\dbh.php";
    
    if (isset($_POST['login_submit123'])){
        $till_id = $_POST['uname'];
        $passwd = $_POST['password'];

        // check for empty fields
        if (empty($till_id) || empty($passwd)){
            header('Location: ..\pages\login_page.php?result=empty');
            exit(); 
        }

        //check for the valid email
        else if(!preg_match( "/^[a-zA-Z0-9]*$/" , $till_id)){
            header('Location: ..\pages\login_page.php?result=unamesy');
            exit();
        }

        //connect to the sql database
 
        else{

            $sql = "SELECT * from users WHERE uname = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header('Location: ..\pages\login_page.php?result=sql');
                exit();
            }else {
                mysqli_stmt_bind_param($stmt, "s", $till_id);
                mysqli_stmt_execute($stmt);     
                $result = mysqli_stmt_get_result($stmt);

                if($row = mysqli_fetch_assoc($result)){

                    $passwd_check = password_verify($passwd, $row['passwd']);

                    if($passwd_check == false){
                        header('Location: ..\pages\login_page.php?result=passwd');
                        exit();
                    }else if ($passwd_check == true){
                        session_start();
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['user_name'] = $row['uname'];
                        $_SESSION['user_id'] = $row['id'];

                        header('Location: ..\index.php');
                        exit();
                    }

                }else{
                    header('Location: ..\pages\login_page.php?result=nouser');
                    exit();
                }

             
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }

    }// end of main isset if statement
    else{
        header('Location: ..\pages\login_page.php');
        exit();
    }

?> 
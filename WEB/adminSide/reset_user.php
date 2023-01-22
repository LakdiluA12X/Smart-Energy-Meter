<?php
    include_once "..\includes\dbh.php";
    session_start();

    if (!isset($_SESSION['id'])){
        header("Location: login_page.php");
        exit();
    }


    if(isset($_POST['fetch_data'])){
        // Now check if the given criteria existss
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: reset_user.php?result=sql');
            exit();
        }else {
            mysqli_stmt_bind_param($stmt, "i", $_POST['id']);
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)){
                $name  = $row['name'];
                $nic   = $row['nic'];
                $idn   = $row['idn'];
                $home  = $row['home'];
                $road  = $row['road'];
                $city  = $row['city'];
                $id    = $row['id'];
            }else{
                // return to reset page, because there is no user
                header('Location: reset_user.php?result=userdextyoo');
                exit();
            }

        }// end of checking prepare
    }//end of isset fetch



?>
 
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Admin</title>
  </head>



  <body>
    <!--Add users to the database-->
    <?php 
    $_SESSION['active'] = 'reset_user';
    include_once "header.php";
    ?>

    <div class = 'text-center mt-4'>
        <img class = "mt-4 mb-4" src="https://iconape.com/wp-content/png_logo_vector/ceylon-electricity-board-logo.png" height = '72px' alt="CEB icon">
        <h1 class = 'h3 mb-3 font-weight-normal'>Admin User Reset Portal</h1>



        <form style = 'max-width:400px; margin:auto;' action="reset_user.php" method='post'>


            <input class = "form-control mb-1" type="number" name='id' placeholder='Account Number'>
            <input class = "form-control mb-1" type="text" name='uname' placeholder='User Name'>


            <div class = "mt-3">
                <button class = 'btn btn-lg btn-primary w-100' type='submit' name='fetch_data'>
                    Fetch User Data
                </button>
            </div>
            <br>
        </form>




        <form style = 'max-width:400px; margin:auto;' action="reset_user_script.php" method='post'>


            <input type="hidden" name="id" <?php if(isset($name)) echo "value=".$id; ?>>
            <input class = "form-control mb-1" type="text" name='name' placeholder='New Full Name' <?php if(!isset($name)) echo "disabled";else echo "value=".$name;?>>
            <input class = "form-control mb-1" type="text" name='nic' placeholder='New NIC' <?php if(!isset($name)) echo "disabled";else echo "value=".$nic;?>>
            <input class = "form-control mb-1" type="text" name='idn' placeholder='New Device ID' <?php if(!isset($name)) echo "disabled";else echo "value=".$idn;?>>
            <input class = "form-control mb-1" type="text" name='home' placeholder='New Home Number' <?php if(!isset($name)) echo "disabled";else echo "value=".$home;?>>
            <input class = "form-control mb-1" type="text" name='road' placeholder='New Road Address' <?php if(!isset($name)) echo "disabled";else echo "value=".$road;?>>
            <input class = "form-control mb-1" type="text" name='city' placeholder='New City' <?php if(!isset($name)) echo "disabled";else echo "value=".$city;?>>

            


            <div class = "mt-3">
                <button class = 'btn btn-lg btn-primary w-100' type='submit' name='reset_submit' <?php if(!isset($name)) echo "disabled";?>>
                    Reset Submit
                </button>
            </div>

            <?php
                if (isset($_GET['result']) && isset($_GET['pass'])){
                    echo "<div class = 'mt-3'><p>User Added. Temporary password: ".$_GET['pass']."</p></div>";
                }
            ?>
        </form>
    </div>




















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>

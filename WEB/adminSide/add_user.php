<?php
    include_once "..\includes\dbh.php";
    session_start();

    if (!isset($_SESSION['id'])){
        header("Location: login_page.php");
        exit();
    }
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
    $_SESSION['active'] = 'add_user';
    include_once "header.php";
    ?>

    <div class = 'text-center mt-4'>
        <form style = 'max-width:400px; margin:auto;' action="add_user_script.php" method='post'>
            <img class = "mt-5 mb-4" src="https://iconape.com/wp-content/png_logo_vector/ceylon-electricity-board-logo.png" height = '72px' alt="CEB icon">
            <h1 class = 'h3 mb-3 font-weight-normal'>Admin User Add</h1>

            <input class = "form-control mb-1" type="text" name='name' placeholder='Full Name'>
            <input class = "form-control mb-1" type="number" name='id' placeholder='Account Number'>
            <input class = "form-control mb-1" type="text" name='nic' placeholder='NIC'>
            <input class = "form-control mb-1" type="text" name='idn' placeholder='Device ID'>
            <input class = "form-control mb-1" type="text" name='uname' placeholder='User Name'>
            <input class = "form-control mb-1" type="text" name='home' placeholder='Home Number'>
            <input class = "form-control mb-1" type="text" name='road' placeholder='Road Address'>
            <input class = "form-control mb-1" type="text" name='city' placeholder='City'>

            <div class = "mt-3">
                <button class = 'btn btn-lg btn-primary w-100' type='submit' name='login_submit'>
                    Add User
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

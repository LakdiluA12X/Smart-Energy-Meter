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
    
    <?php 
    $_SESSION['active'] = 'user_search';
    include_once "header.php";
    ?>



    <div class = 'container'>
        <div class = 'row'>
            <div <?php if (isset ($_POST['submit'])) {echo "class = col-0";} else {echo "class = col-4";}?>>
            </div>

            <div <?php if (isset ($_POST['submit'])) {echo "class = col-3";} else {echo "class = col-4";}?>>
                <!--User search form goes here-->
                <form class = "mt-5" action="user_search.php" method = 'post'>
                    <h1 class = 'h3 mb-3 font-weight-normal  text-center'>Consumption Search</h1>

                    <p> Please enter your query to search the database. Fill the fields to filter. Attention the name search will be inaccurate if spellings are wrong. Leave all text boxes empty if you want to view all data in the database. </p>

                    <input class = "form-control mb-1" type="text" name='name' placeholder='Name' autocomplete="off">
                    <input class = "form-control mb-1" type="number" name='id' placeholder='Account Number' autocomplete="off">
                    <input class = "form-control mb-1" type="text" name='nic' placeholder='NIC' autocomplete="off">
                    <input class = "form-control mb-1" type="text" name='uname' placeholder='User Name' autocomplete="off">
                    <input class = "form-control mb-1" type="date" name='date' placeholder='Date' autocomplete="off">
                    <input class = "form-control mb-1" type="text" name='address' placeholder='Address' autocomplete="off">
                    
                    <select class="form-control mb-1" name = 'comb'>
                        <option value = 'and' selected>AND Combination</option>
                        <option value="or">OR Combination</option>
                    </select>

                    <div class = "mt-3">
                        <button class = 'btn btn-lg btn-primary w-100' type='submit' name='submit'>
                            Search
                        </button>
                    </div>
                </form>

            </div>


            <div <?php if (isset ($_POST['submit'])) {echo "class = col-9";} else {echo "class = col-4";}?>>
                <?php
                    if (isset($_POST['submit'])){

                        // First of all make the user finding filter
                        if ($_POST['comb'] == 'and'){
                            $querry_u = "";
                            $querry_c = "";
                            foreach ($_POST as $key => $value) {
                                if (!empty($value) && $key != 'submit' && $key != 'comb'){
                                    if ($key == 'date'){
                                        $value = str_replace("-", "", $value);
                                        $querry_c = " and ".$key."='".$value."'";
                                    } 
                                    else{
                                        $querry_u .= $key."='".$value."' and ";
                                    } 
                                }
                            }
                            if (!empty($querry_u)) $querry_u = "WHERE ".$querry_u." 1=1";
                        }

                        else if ($_POST['comb'] == 'or'){
                            $querry = "";
                            $querry_c = "";
                            foreach ($_POST as $key => $value) {
                                if (!empty($value) && $key != 'submit' && $key != 'comb'){
                                    if ($key == 'date'){
                                        $value = str_replace("-", "", $value);
                                        $querry_c = " or ".$key."=".$value;
                                    }
                                    else{
                                        $querry_u .= $key."='".$value."' or ";
                                    }
                                }
                            }
                            if (!empty($querry_u)) $querry_u = "WHERE ".$querry_u." 1=0";
                        }



                        // now selecting from the database

                        // first select all data from user table for given querry
                        $sql = "SELECT id, idn,  name, home, road, city FROM users ".$querry_u;
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0){
                            echo "<div class = 'mt-5' style = 'height: 600px;overflow-y: auto;'>";
                            echo "<table class='table'>";
                            echo "<thead class='table-dark'><tr> <th>ID</th> <th>Name</th> <th>Address</th> <th>Date</th> <th>Consumtion</th> </tr></thead>";


                            while ($row = mysqli_fetch_assoc($result)){
                               
                                // now select from the consumption where the id and the date
                                $sqlc = "SELECT * FROM consumption WHERE id=".$row['id'].$querry_c;
                                $resultc = mysqli_query($conn, $sqlc);

                                if(mysqli_num_rows($resultc) > 0){
                                    while($rowc = mysqli_fetch_assoc($resultc)){

                                        $addr = $row['home'].", ".$row['road'].", ".$row['city'];
                                        $date = mb_substr($rowc['date'], 0, 4)."-".mb_substr($rowc['date'],4, 2)."-".mb_substr($rowc['date'], 6, 2);
                        
                                        echo "<tr> <td>".$row['id']."</td> <td>".$row['name']."</td> <td>".$addr."</td> <td>".$date."</td> <td>".$rowc['consumption']."</td> </tr>";

                                    }// end of the while loop
                                }
                            }

                            echo "</table></div>";
                        }// end of the main if statement
                        else{
                            echo "<h1 class = 'h3 mt-5 font-weight-normal'>No Results For your Querry!! Try OR combination</h1>";
                        }
                        #include 'user_search_table_script.php';
                    }
                ?>

                
            </div>


        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>

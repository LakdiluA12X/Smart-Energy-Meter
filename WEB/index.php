<?php
    include_once "includes\dbh.php";
    include_once "includes\\functions.php";
    session_start();

    if (!isset($_SESSION['user_id'])){
        header("Location: pages\login_page.php");
        exit();
    }else{

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

    <title>CEB User</title>

 




  </head>

  <body>
    
    <?php 
      // the active tab is home so say home
      $_SESSION['active'] = 'home';
      include_once "pages\header.php";
    ?>

    <br>
    <br>

    <div class = 'container'>
      <div class='row'>
        <div class='col-4'>

          <div class = 'row'>
            <div class = 'text-center'>
             <h1 class = 'h3 mb-3 font-weight-normal'>Monthly Running Statistics</h1>
            </div>
          </div>

          <div class = 'row'>
            <div class = 'text-center'>


            <div class="container mt-3">          
              <table class="table">
                <thead>
                  <tr>
                    <th>Parameter</th>
                    <th>Value</th>
                    <th>Unit</th>
                  </tr>
                </thead>

                <?php $calculated_data = calcBill($_SESSION['user_id'], date('Ym')."%%", $conn) ?>

                <tbody>
                  <tr>
                    <td>Total Units</td>
                    <td> <?php echo round($calculated_data[0], 2) ?> </td>
                    <td>unit/kWh</td>
                  </tr>
                  <tr>
                    <td>Average</td>
                    <td> <?php echo round($calculated_data[1],2) ?> </td>
                    <td>unit/kWh</td>
                  </tr>
                  <tr>
                    <td>STD</td>
                    <td> <?php echo round($calculated_data[2],2) ?> </td>
                    <td>unit/kWh</td>
                  </tr>
                  <tr>
                    <td>Price</td>
                    <td> <?php echo round($calculated_data[3],2) ?> </td>
                    <td>Rs.</td>
                  </tr>
                </tbody>
              </table>
            </div>



            </div>
          </div>

          <br>
        
          <div class = 'row'>
            <div class = 'text-center'>
             <h1 class = 'h3 mb-3 font-weight-normal'>Future Preditions</h1>
            </div>
          </div>

          <div class = 'row'>
          <div class = 'text-center'>


            <div class="container mt-3">          
              <table class="table">
                <thead>
                  <tr>
                    <th>Parameter</th>
                    <th>Value</th>
                    <th>Unit</th>
                  </tr>
                </thead>

                <?php $calculated_data = calcBill($_SESSION['user_id'], date('Ym')."%%", $conn) ?>

                <tbody>
                  <tr>
                    <td>Total Units</td>
                    <td> <?php echo round($calculated_data[1] * 30, 2) ?> </td>
                    <td>unit/kWh</td>
                  </tr>
                  <tr>
                    <td>Price</td>
                    <td> <?php echo round(calcBill($_SESSION['user_id'], date('Ym')."%%", $conn, $calculated_data[1] * 30)[0],2) ?> </td>
                    <td>Rs.</td>
                  </tr>
                  <tr>
                    <td>90 Unit will Exceed</td>
                    <td> 
                      <?php 
                        if($calculated_data[1]){
                          echo round((90 - $calculated_data[0]) / $calculated_data[1]);
                        }else{
                          echo 0;
                        }
                        
                      ?> 
                    </td>
                    <td>days</td>
                  </tr>
                  <tr>
                    <td>120 Unit will Exceed</td>
                    <td> 
                      <?php
                        if($calculated_data[1]){
                          echo round((120 - $calculated_data[0]) / $calculated_data[1]);
                        } else{
                          echo 0;
                        }
                       
                      ?> 
                    </td>
                    <td>days</td>
                  </tr>
                </tbody>
              </table>
            </div>



            </div>
          </div>

        </div>

        <div class = 'col-8'>

          <div class = 'row'>
            <div class = 'text-center'>
             <h1 class = 'h3 mb-3 font-weight-normal'>Monthly Usage Summery</h1>
            </div>
          </div>

          <canvas id="myChartID"></canvas>

        </div>
      
      </div>
    </div>

    <!--End of the main container-->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    
    <script language="JavaScript" type="text/javascript" src='includes\jquery.min.js'></script>
    <script language="JavaScript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script language="JavaScript" type="text/javascript" src='includes\mychart.js'></script>


  </body>
</html>
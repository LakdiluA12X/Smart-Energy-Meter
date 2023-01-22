<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Admin Signin</title>
  </head>
  <body>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <div class = 'text-center mt-5'>
        <form style = 'max-width:400px; margin:auto;' action="signin.php" method='post'>
            <img class = "mt-5 mb-4" src="https://iconape.com/wp-content/png_logo_vector/ceylon-electricity-board-logo.png" height = '72px' alt="CEB icon">
            <h1 class = 'h3 mb-3 font-weight-normal'>Admin Till SignIN</h1>

            <input class = "form-control mb-1" type="text" name='name' placeholder='Full Name' required autofocus>
            <input class = "form-control mb-1" type="text" name='uname' placeholder='User Name'>
            <input class = "form-control mb-1" type="password" name='password' placeholder='Password'>
            <input class = "form-control mb-1" type="password" name='repassword' placeholder='Re-Password'>

            <div class = "mt-3">
                <button class = 'btn btn-lg btn-primary w-100' type='submit' name='login_submit'>
                    Sign In
                </button>
            </div>

        </form>
    </div>









    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>

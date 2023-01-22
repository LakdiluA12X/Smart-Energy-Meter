<style>
    body {
      background-image: url('includes/background.jpeg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
    }
</style> 

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">

    <a class="navbar-brand" href="#">Hi!</a>
    <span class="navbar-text"> <?php echo $_SESSION['name']; ?> </span>
    
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse ms-5" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <?php 
            if ($_SESSION['active'] == 'home') echo "<a class='nav-link active' aria-current='page' href='#'>Home</a>";
            else echo "<a class='nav-link' aria-current='page' href='../index.php'>Home</a>";
          ?>
        
        </li>
        <li class="nav-item">
        
          <?php 
            if ($_SESSION['active'] == 'log') echo "<a class='nav-link active' href='#'>Month Log</a>";
            else echo "<a class='nav-link' href='pages/month_log.php'>Month Log</a>";
          ?>
        
        </li>
        <li class="nav-item">
        
          <?php 
            if ($_SESSION['active'] == 'stat') echo "<a class='nav-link active' href='#'>Statistics</a>";
            else echo "<a class='nav-link' href='#'>Statistics</a>";
          ?>
        
        </li>

        <li class="nav-item">
        
          <?php 
            if ($_SESSION['active'] == 'accnt') echo "<a class='nav-link active' href='#'>My Account</a>";
            else echo "<a class='nav-link' href='#'>My Account</a>";
          ?>
        
        </li>
      </ul>
    </div>


    <form class="d-flex" action="s\logout.php" method = 'post'>
        <button type="submit" class="btn nav-link" name='logout'>Logout</button>
    </form>

  </div>
</nav>
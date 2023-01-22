<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">

    <a class="navbar-brand" href="#">CEB</a>
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
            else echo "<a class='nav-link' aria-current='page' href='index.php'>Home</a>";
          ?>
        
        </li>
        <li class="nav-item">
        
          <?php 
            if ($_SESSION['active'] == 'user_search') echo "<a class='nav-link active' href='#'>User Search</a>";
            else echo "<a class='nav-link' href='user_search.php'>User Search</a>";
          ?>
        
        </li>

        <li class="nav-item">
        
          <?php 
            if ($_SESSION['active'] == 'add_user') echo "<a class='nav-link active' href='#'>Add User</a>";
            else echo "<a class='nav-link' href='add_user.php'>Add User</a>";
          ?>
        
        </li>
        <li class="nav-item">
        
        <?php 
          if ($_SESSION['active'] == 'reset_user') echo "<a class='nav-link active' href='#'>Reset User</a>";
          else echo "<a class='nav-link' href='reset_user.php'>Reset User</a>";
        ?>
      
      </li>
      </ul>
    </div>


    <form class="d-flex" action="logout.php" method = 'post'>
        <button type="submit" class="btn nav-link" name='logout'>Logout</button>
    </form>

  </div>
</nav>
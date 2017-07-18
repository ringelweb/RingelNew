<!-- Navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><strong><i class="glyphicon glyphicon-home xx"> RINGEL</i></strong></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <?php
                if (isset($_SESSION['user_name'])) {
                    ?>
                <li><a href = "home1.php"><span class = "glyphicon glyphicon-home"></span> Home </a></li>
                    <li><a href = "seller_account.php"><span class = "glyphicon glyphicon-cog"></span> Settings </a></li>
                    <li><a href = "seller_profile.php"><span class = "glyphicon glyphicon-user"></span> Profile</a></li>
                    <li><a href = "logout_script.php"><span class = "glyphicon glyphicon-log-out"></span> Logout</a></li>
                   
                    <?php
                } else {
                    ?>
                       <li><a data-toggle="modal" data-target="#loginModal" href="loginScript.php"><i class="glyphicon glyphicon-log-in x"> Login</i></a></li>
                     <?php }?>
      </ul>
    </div>
  </div>
</nav>
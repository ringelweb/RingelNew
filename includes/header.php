<!-- Navbar -->

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><strong><i class="glyphicon glyphicon-home xx"> RINGEL</i></strong></a>
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
                }else if(isset($_SESSION['buyer_user_name'])) { ?>
				     <li><a href = "home1.php"><span class = "glyphicon glyphicon-home"></span> Home </a></li>
                     <li><a href = "buyer_account.php"><span class = "glyphicon glyphicon-cog"></span> Settings </a></li>
                    <li><a href = "buyer_profile.php"><span class = "glyphicon glyphicon-user"></span> Profile</a></li>
					 <li><a href = "logout_script.php"><span class = "glyphicon glyphicon-log-out"></span> Logout</a></li>
                    <?php } else {?>
                       <li><a data-toggle="modal" data-target="#loginModal" href="#"><i class="glyphicon glyphicon-log-in x"> Login</i></a></li>
                <?php
                       $currentpage = $_SERVER['REQUEST_URI'];
					   echo "<script>alert($currentpage)</script>";
					   //$currentpage=="/RingelNew/index.php"    to be change later
                       if (!($currentpage=="/RingelNew/" || $currentpage=="/RingelNew/index.php" || $currentpage=="" )) {?>
                      <li><a  href="index.php"><i class="glyphicon glyphicon-user x"> <?php echo "Register" ?></i></a></li>
					  <?php
                         }
                        ?>      
				   <?php }?>
					
						
                                        
					
      </ul>
    </div>
  </div>
</nav>
<div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
        <form action="login_script.php" method="post">  
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login</h4>
        </div>
        <div class="modal-body">
         <div class="form-group">
         <label>Username:</label>
        <input class="form-control" name="username" type="text" >
        </div>
         <div class="form-group">
         <label>Password:</label>
         <input class="form-control"name="password" type="password" >
          </div>
          <div class="row">
          <div class="col-sm-2">
        <label>  Log In As:</label>
          </div>
            <div class="col-sm-4">
                 <div class="radio">
                    <input id="seller" name="usertype" type="radio" value="seller">
                     <label for="seller" class="radio-label">Seller</label> 
                  </div> 
                  </div>
                    <div class="col-sm-4">
                  <div class="radio">
                    <input id="buyer" name="usertype" type="radio" value="buyer"  checked>
                    <label for="buyer" class="radio-label ">Buyer</label>
                  </div>
                  </div>
           </div>
        
         
         
        </div>
        <div class="modal-footer">
        <div style="float:left;margin-left:20px;" class="row">
          <button readOnly class="loginBtn loginBtn--facebook">Login with Facebook</button></div> 
          <input type="submit" class="btn btn-primary" value="login">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      </form> 
    </div>
  </div>

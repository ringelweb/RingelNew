<?php
require 'includes/connect.php';

 //Declaring variables to prevent error
if(isset($_SESSION['buyer_user_name'])||isset($_SESSION['user_name']))
{
    header('Location: home1.php');
}

$user_id="";
$pass_1 = "";
$pass_2 = "";
$error_array = array();
if(isset($_POST['buyer_reg'])){

	$buyer_user_name = strip_tags($_POST['user_name']); 
 	$_SESSION['buyer_user_name'] = $buyer_user_name; 

 	$pass_1 = strip_tags($_POST['pass1']);

 	$pass_2 = strip_tags($_POST['pass2']);


 	if($pass_1 != $pass_2) {
 		array_push($error_array, "Your passwords dont match<br>");
 	}
 	else{
 		if(preg_match('/[^A-Za-z0-9]/', $pass_1)){
 			array_push($error_array, "Your password can only contain english characters or numbers<br>");
 		}
 	}

 	if( strlen($pass_1) > 40 || strlen($pass_1) < 5 ) {
 		array_push($error_array, "Your password must be between 5 and 40 characters<br>");
 	}

 	if(empty($error_array)) {

 		$pass_1 = md5($pass_1);
	}
 	$check_username_query = mysqli_query($con,"SELECT username FROM buyer_users WHERE username = '$buyer_user_name'");
 	$count = mysqli_num_rows($check_username_query);
 	if($count > 0)
 		array_push($error_array, "This user id is taken...<br>");
 	if(empty($error_array)) {
 		$query =mysqli_query($con,"INSERT INTO buyer_users VALUES ('','$buyer_user_name','$pass_1')");
                session_start();
                $_SESSION['buyer_user_name'] =$buyer_user_name;
 		header("Location: home1.php");
 		$_SESSION['pass1'] = "";
 		$_SESSION['pass2'] = "";
	}
}
 	?>






<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>RINGEL</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php include ("includes/header.php") ?>

<div class="container margin-container">
<?php if(isset($_GET['error'])){ 
?>
<div class="row text-center well error">
<?php echo $_GET['error'] ?>
</div>
<?php } ?>


<?php if(isset($_GET['msg'])){ 
?>
<div class="row text-center well error">
<?php echo $_GET['msg'] ?>
</div>
<?php } ?>

<div class="row">

  <div class="col-sm-6 div-hover div-pad" style=" padding-bottom: 90px;">
  <H1>WELCOME TO RINGEL</H1>
   <p>BROUGHT TO YOUO BY RINGELWEB.COM</p>
      <p>A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.A new Concept to make E-commerce more interesting.</p>
 <a href="seller_reg1.php"><button class="btn btn-primary" >SELLER REGISTRATION</button></a>
  </div>
  <div class="col-sm-5  col-sm-offset-1 text-center div-hover div-pad">
 
  <h3>Buyer Registration</h3><hr>

 <form   method="get" onSubmit="return check();" name="buyer_reg" action="index.php">
  <div class="form-group">
  <label>USERNAME</label>
  <input class="form-control" type="text" placeholder="Choose Your Username" name="user_name"  required = "true" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" >
  </div>
    <span class="error">    <?php 
						if(isset($_SESSION['user_name'])) {
							echo $_SESSION['user_name'];
							} 
							?>
							<?php if(in_array("This user id is taken...<br>", $error_array))  echo "This user id is taken...<br>";?>
  </span>
   <div class="form-group">
  <label>PASSWORD</label>
    <input class="form-control" type="password" placeholder="Choose Password" pattern=".{6,}" name="pass1" required = "true" >
  </div>
  
   <div class="form-group">
   <label>CONFIRM PASSWORD</label>
  <input class="form-control" type="password" placeholder="Retype Password" pattern=".{6,}" name="pass2" required = "true" >
  </div>
  
  <span class="error">
   <?php if(in_array("Your passwords dont match<br>", $error_array))  echo "Your passwords dont match<br>";
						 else if(in_array("Your password can only contain english characters or numbers<br>", $error_array))  echo "Your password can only contain english characters or numbers<br>";
						 else if(in_array("Your password must be between 5 and 40 characters<br>", $error_array))  echo "Your password must be between 5 and 40 characters<br>";?>
  </span>
  
 <div class="form-group">
<input type="submit" value="Register Now"class="btn btn-primary">
</div>
  </form>
 <strong> OR</strong><br>
 <button class="loginBtn loginBtn--facebook">Login with Facebook</button></div>
 
 
  </div>
</div>

</div>

<!-- modal -->
 
<br><br><br><br><br>

<?php include ("includes/footer.php") ?>
</body>

</html>

<?php

require 'includes/connect.php';

 //Declaring variables to prevent error

$user_id="";
$pass_1 = "";
$pass_2 = "";
$error_array = array();

if(isset($_POST['user_reg'])){

	$user_id = strip_tags($_POST['user_name']); 
 	$_SESSION['user_name'] = $user_id; 

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

 	$check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username = '$user_id'");

 	$count = mysqli_num_rows($check_username_query);

 	if($count > 0)
 		array_push($error_array, "This user id is taken...<br>");

 	if(empty($error_array)) {

 		$query =mysqli_query($con,"INSERT INTO users VALUES ('','$user_id','$pass_1')");
                session_start();
                $_SESSION['user_name'] =$user_id;
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
            

		<div class="container margin-container  div-hover">
	<center>	<img src="img/icons/security.png" width="200px"></center>
		  <div class="col-sm-9 col-sm-offset-3"style="padding-left:90px;"><h3>Create Username and Password</h3></div>
		  <form class="form-horizontal col-sm-9 col-sm-offset-3" id = "" action="seller_reg2.php" method="POST">
		
		  <br>
		  
			    <div class="form-group">
			      <label class="control-label xx-2 col-sm-2" >Username:</label>
			      <div class="xx-1 col-sm-5">
			        <input type="text" class="form-control"  placeholder="Pick a Username" name="user_name"  value="<?php 
						if(isset($_SESSION['user_name'])) {
							echo $_SESSION['user_name'];
							} 
							?>" required>
							<br>
						<?php if(in_array("This user id is taken...<br>", $error_array))  echo "This user id is taken...<br>";?>
			      </div>
			    
			      
			    </div>

			    <div class="form-group">
			      <label class="control-label xx-2 col-sm-2" >Password:</label>
			      <div class="xx-1 col-sm-5">
			        <input type="password" class="form-control"  placeholder="****" name="pass1" required>
			      </div>
			    
			      
			    </div>

			    <div class="form-group">
			      <label class="control-label xx-2 col-sm-2" >Confirm Password:</label>
			      <div class="xx-1 col-sm-5">
			        <input type="password" class="form-control"  placeholder="****" name="pass2" required>

			        <br>

						<?php if(in_array("Your passwords dont match<br>", $error_array))  echo "Your passwords dont match<br>";
						 else if(in_array("Your password can only contain english characters or numbers<br>", $error_array))  echo "Your password can only contain english characters or numbers<br>";
						 else if(in_array("Your password must be between 5 and 40 characters<br>", $error_array))  echo "Your password must be between 5 and 40 characters<br>";?>
			      </div>
			    
			      
			    </div>


		    
			   

			     <div class="form-group"> 
				 <div class=" xx-2 col-sm-8">
				 <input type="submit" class="btn btn-lg btn-block btn-success " value="Register" name="user_reg">
				
				 </div>

				 </div>

		   
		  </form>
		</div>
		<br><br>
            <?php include 'includes/footer.php'; ?>
	</body>
	
</html>
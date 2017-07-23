<?php
	require ("includes/connect.php");
	require ("seller_handler.php");
	
	if (isset($_SESSION['user_name'])) {
     $user_name=$_SESSION['user_name'];
     $sellerid=$_SESSION['sellerid'];
    
        


$result = mysqli_query($con,"SELECT ownername , gender , dob , address , mobile , email  FROM seller_info WHERE sellerid ='".$sellerid."'"); 
$row=mysqli_fetch_array($result);
$ownername = $row['ownername'];
$gender = $row['gender'];
$dob = $row['dob'];
$address = $row['address'];
$mobile = $row['mobile'];
$email = $row['email'];
        $result1 = mysqli_query($con,"SELECT * FROM org_info WHERE sellerid ='".$sellerid."'"); 
        $row1= mysqli_fetch_array($result1);
        $orgname = $row1['orgname'];
$category = $row1['category'];
$contact = $row1['contact'];
$orgaddress = $row1['address'];
$orgemail= $row1['email'];
$siteurl=$row1['siteurl'];
$coverimage=$row1['coverimage'];
$description=$row1['description'];
        
        }


?>
 <!DOCTYPE html>
 <html>
 <title>Account Settings</title>
 <head>

 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </head>
 
 <body>
<center><h3>Account Settings</h3></center>
 

<div class="container">
		<form id = "update" action="seller_account.php" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6 ">
			  			<div class="panel panel-success">
					      <div class="panel-heading">Personal Settings</div>
					      <div class="panel-body">

					      		<div class="form-group">
								    <label>Name</label>
								    <div class="well"><?php echo $ownername; ?></div>
								</div>
								<div class="form-group">
									<label>Gender</label><br>
								    <div class="well"><?php echo $gender; ?></div>
								</div>
								<div class="form-group">
								    <label>D.O.B</label>
								    <div class="well"><?php echo $dob; ?></div>
								</div>

								<div class="form-group">
								    <label>Address</label>
								    <textarea class="form-control"  name="sell_address"  ><?php echo $address; ?></textarea>
								</div><br>

								<div class="form-group">
								    <label>Mobile</label>
								    <input type="text" class="form-control" name = "mobile" placeholder="<?php echo $mobile;?>">
								    <?php if(in_array("Enter a valid 10 digit mobile no.<br>", $error_array))  echo "Enter a valid 10 digit mobile no.<br>";
						 ?>

								</div><br>

								<div class="form-group">
								    <label>Email</label>
								    <input type="email" class="form-control" name = "owner_email" placeholder="<?php echo $email; ?>">
								    <?php if(in_array("Email already in use<br>", $error_array))  echo "Email already in use<br>";
						 else if(in_array("INAVLID FORMAT<br>", $error_array))  echo "INAVLID FORMAT<br>";?>
								    
								</div>
								<br><br>




					      </div>
					    </div>
			  		</div>

			  		<div class="col-md-6 ">
			  			<div class="panel panel-info">
					      <div class="panel-heading">Store Settings</div>
					      <div class="panel-body">

					      	<div class="form-group">
								    <label>Store Name</label>
								    <div class="well"><?php echo $orgname; ?></div>
								</div>
								<div class="form-group">
									<label>Category</label>
								    <div class="well"><?php echo $category; ?></div>
								</div>
								<div class="form-group">
								    <label>Address</label>
								    <textarea class="form-control"  name = "org_address"  ><?php echo $orgaddress; ?></textarea>
								</div>

								<div class="form-group">
								    <label>Contact</label>
								    <input type="text" class="form-control" name = "contact" placeholder="<?php echo $contact;?>">
								    <?php if(in_array("Enter a valid 10 digit contact no.<br>", $error_array))  echo "Enter a valid 10 digit contact no.<br>";
						 ?>
								</div>

								<div class="form-group">
								    <label>Email</label>
								    <input type="email" class="form-control" name = "org_email" placeholder="<?php echo $orgemail; ?>">

						<?php if(in_array("This Email already in use<br>", $error_array))  echo "This Email already in use<br>";
						 else if(in_array("INAVLID FORMAT!<br>", $error_array))  echo "INAVLID FORMAT!<br>";?>
								    
								</div>

								<div class="form-group">
								    <label>Website</label>
								    <input type="url" class="form-control" name = "website" placeholder="<?php echo $siteurl; ?>">
								    <?php if(in_array("This website is already in use<br>", $error_array))  echo "This website is already in use<br>";?>
								    
								</div><br>

								<div class="form-group">
								    <label>Store Description</label>
								     <textarea class="form-control"  name="org_description"  ><?php echo $description; ?></textarea>
								    
								</div>

					      </div>
					    </div>
			  		</div>
			  	</div>

			  	<div class="row">
					<div class="col-md-6 ">
			  			<div class="panel panel-warning">
					      <div class="panel-heading">Bank Details</div>
					      <div class="panel-body">

					      	<div class="form-group">
								    <label>Account no.</label>
								    <input type="text" class="form-control" name="acc_no" placeholder="">
								    
							</div>

							<div class="form-group">
								    <label>IFSC</label>
								    <input type="text" class="form-control" name="ifsc" placeholder="">
								    
							</div>

							<div class="form-group">
								    <label>Holder's Name</label>
								    <input type="text" class="form-control" name="holder_name" placeholder="">
								    
							</div>

							<div class="form-group">
								    <label>Branch Address</label>
								    <textarea class="form-control"  name="branch_address"  ></textarea>
								    
							</div>
					      		

					      </div>
					    </div>
			  		</div>

			  		<div class="col-md-6 ">
			  			<div class="panel panel-danger">
					      <div class="panel-heading">Change Password</div>
					      <div class="panel-body">

					      	<div class="form-group">
								    <label>Enter Old Password</label>
								    <input type="password" class="form-control" name="old_password" placeholder="">
								    <?php if(in_array("Incorrect Password!!<br>", $error_array))  echo "Incorrect Password!!<br>";?>
								    
							</div><br>

							<div class="form-group">
								    <label>Enter New Password</label>
								    <input type="password" class="form-control" name="new_password" placeholder="">
								    
								    
							</div><br>

							<div class="form-group">
								    <label>Confirm Password</label>
								    <input type="password" class="form-control" name="confirm_password" placeholder="">
								    <?php if(in_array("Passwords dont match!!<br>", $error_array))  echo "Passwords dont match!!<br>";?>
								    
							</div>
							<br><br>


					      </div>
					    </div>
			  		</div>
			  	</div>

			  	<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">Change Cover Image </div>
						      <div class="panel-body">

						      	
                                 
								    
								    <input type='hidden' name='size' value='1000000'>
                                                <div>
                                             Select image to upload:<input type="file" name="image">
                                             
                                               </div>

								    
								   

						      </div>
					    </div>
					</div>
					<br><br>
					<div class=" col-md-offset-2 col-md-2">
				 <input type="submit" class="btn btn-block btn-success " value="Update" name="update">
				 </div>
			  		
			  	</div>

		</form>	  	
	</div>
 </body>
 </html>
 <?php 
 $_SESSION['sellerid']=$sellerid; 
 $_SESSION['user_name']=$user_name; 
 ?>

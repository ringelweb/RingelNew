<?php
	require ("includes/connect.php");
	
	if (isset($_SESSION['user_name'])) {
     $user_name=$_SESSION['user_name'];
     $sellerid=$_SESSION['sellerid'];
     if (isset($_POST['old_password'])) {
        $old_password = strip_tags($_POST['old_password']);
	   $old_password= md5($old_password);
	   $_SESSION['old_password']  = $old_password;
	 }
        
 if (isset($_POST['new_password'])) {
	$new_password = strip_tags($_POST['new_password']);
        $new_password= md5($new_password);
	$_SESSION['new_password']  = $new_password;
	$confirm_password = strip_tags($_POST['confirm_password']);
	$_SESSION['confirm_password']  = $confirm_password;
        
 }
$result = mysqli_query($con,"SELECT* FROM seller_info WHERE sellerid ='".$sellerid."'"); 
$row=mysqli_fetch_array($result);
$ownername = $row['ownername'];
$gender = $row['gender'];
$dob = $row['dob'];
$address = $row['address'];
$mobile = $row['mobile'];
$email = $row['email']; 
$bank_details_filled = $row['bank_details_filled'];

$result1 = mysqli_query($con,"SELECT * FROM org_info WHERE sellerid ='".$sellerid."'"); 
$row1= mysqli_fetch_array($result1);
$orgname = $row1['orgname'];
$category = $row1['category'];
$contact = $row1['contact'];
$orgaddress = $row1['address'];
$orgemail= $row1['email'];
$siteurl=$row1['siteurl'];
$description=$row1['description']; 
$display_success_message = array();
$error_array=array();
        //array_push($display_success_message, "");
 //if filling data for the first time
//this might cause an error because initially it is empty but data is getting updated into the database!
if($bank_details_filled == 'no')
{
	if (isset($_POST['acc_no'])) {
	$acc_no = strip_tags($_POST['acc_no']); 
 	$_SESSION['acc_no'] = $acc_no;
	}
	if (isset($_POST['ifsc'])) {
 	$ifsc = strip_tags($_POST['ifsc']); 
 	$_SESSION['ifsc'] = $ifsc;
	}
	if (isset($_POST['holder_name'])) {
 	$holder_name = strip_tags($_POST['holder_name']); 
 	$_SESSION['holder_name'] = $holder_name;
	}
	if (isset($_POST['branch_address'])) {
 	$branch_address = strip_tags($_POST['branch_address']); 
 	$_SESSION['branch_address'] = $branch_address;
}}
else    
{	//if already filled ,that is not logging in for the first time then retrieve already stored data and show
	$query_acc = mysqli_query($con,"SELECT * FROM seller_accinfo WHERE sellerid ='".$sellerid."'");
	$run_query= mysqli_fetch_array($query_acc);
    $acc_no = $run_query['bankaccount'];
    $_SESSION['acc_no'] = $acc_no;
	$ifsc = $run_query['ifsc'];
	$_SESSION['ifsc'] = $ifsc;
	$holder_name = $run_query['holdername'];
	$_SESSION['holder_name'] = $holder_name;
	$branch_address= $run_query['branchaddress'];
	$_SESSION['branch_address'] = $branch_address;
} 
 	
$p_check = mysqli_query($con,"SELECT password FROM users WHERE id='$sellerid'");
        $num_rows4 = mysqli_num_rows($p_check);
        if(isset($_POST['upload'])){
             $target = "img/org_coverimg/".basename($_FILES['image']['name']);
        $cover_img= $_FILES['image']['name'];
        $_SESSION['cover_img']= $cover_img;
        move_uploaded_file($_FILES['image']['tmp_name'], $target); 
                $result4= mysqli_query($con,"UPDATE org_info SET coverimage='".$cover_img."' WHERE sellerid='$sellerid'"); 
        
         }
 	//validate password
        //logic to insert or update bank details 
if(isset($_POST['update'])){
        $store_email = strip_tags($_POST['org_email']);  
 	$_SESSION['org_email'] = $store_email;
	
 	$sell_email = strip_tags($_POST['owner_email']); 
 	$_SESSION['owner_email'] = $sell_email;
	
 	$store_address = strip_tags($_POST['org_address']);
 	$_SESSION['org_address'] = $store_address;
	
 	$sell_address = strip_tags($_POST['sell_address']);
 	$_SESSION['sell_address'] = $sell_address;
	
 	$store_contact = strip_tags($_POST['contact']);
 	$_SESSION['contact'] = $store_contact;
	
	if(isset($_POST['mobile'])){
 	$sell_mobile = strip_tags($_POST['mobile']);
 	$_SESSION['mobile'] = $sell_mobile;
	}
	
	if(isset($_POST['website'])){
 	$website = strip_tags($_POST['website']);
 	$_SESSION['website'] = $website;
	}
	
 	$descrip = strip_tags($_POST['org_description']);
 	$_SESSION['org_description'] = $descrip;
         
       
     /*   $w_check = mysqli_query($con,"SELECT siteurl FROM org_info WHERE siteurl='$website'");
 			//count the no. of rows returned
 			$num_rows3 = mysqli_num_rows($w_check);
 			if($num_rows3 > 0)
 			{
 				array_push($error_array, "This website is already in use<br>");
 			}
                        if(filter_var($store_email,FILTER_VALIDATE_EMAIL)) {
 			$store_email = filter_var($store_email,FILTER_VALIDATE_EMAIL);
 			//check if email already exists
 			$e_check = mysqli_query($con,"SELECT email FROM org_info WHERE email='$store_email'");
 			//count the no. of rows returned
 			$num_rows = mysqli_num_rows($e_check);
 			if($num_rows > 0)
 			{
 				array_push($error_array, "This Email already in use<br>");
 			}
 		}
 		else
 		{
 			array_push($error_array, "INAVLID FORMAT!<br>");
 		}
 		if(filter_var($sell_email,FILTER_VALIDATE_EMAIL)) {
 			$sell_email = filter_var($sell_email,FILTER_VALIDATE_EMAIL);
 			//check if email already exists
 			$e_check2 = mysqli_query($con,"SELECT email FROM seller_info WHERE email='$sell_email'");
 			//count the no. of rows returned
 			$num_rows2 = mysqli_num_rows($e_check2);
 			if($num_rows2 > 0)
 			{
 				array_push($error_array, "Email already in use<br>");
 			}
 		}
 		else
 		{
 			array_push($error_array, "INAVLID FORMAT<br>");
 		}
 		if(strlen($store_contact) != 10)  {
 		array_push($error_array, "Enter a valid 10 digit contact no.<br>");
 	}
 		if(strlen($sell_mobile) != 10) {
 		array_push($error_array, "Enter a valid 10 digit mobile no.<br>");
 	} */
       
        
        $result2=mysqli_query($con,"UPDATE seller_info SET address= '".$sell_address."' , mobile='".$mobile."' , email= '".$sell_email."'  WHERE sellerid='$sellerid'");
        $result3= mysqli_query($con,"UPDATE org_info SET address= '".$store_address."' , contact='".$store_contact."' , email= '".$store_email."', siteurl='".$siteurl."', description='".$descrip."' WHERE sellerid='$sellerid'"); 
	
if($num_rows4 == 0)
 	{
 		array_push($error_array, "Incorrect Password!!<br>");
                
 	}
        else{
            
         $result = mysqli_query($con,"UPDATE users SET password ='$new_password' WHERE password='$old_password'");
        }
 	if ($new_password!=$confirm_password) {
 		array_push($error_array, "Passwords dont match!!<br>");
 	}
if($bank_details_filled == 'no'){
	
 	$insert_bank_details_query = mysqli_query($con,"INSERT INTO seller_accinfo VALUES ('$sellerid','$acc_no','$ifsc','$holder_name','$branch_address')");
 	array_push($display_success_message, "Details have been updated successfully<br>");
 	//update seller_info table to indicate that account details have been updated!!
 	$update_seller_info = mysqli_query($con,"UPDATE seller_info SET bank_details_filled = 'yes' WHERE sellerid ='".$sellerid."'");
}
else
{
	$insert_bank_details_query = mysqli_query($con,"UPDATE seller_accinfo SET bankaccount = '".$acc_no."' , ifsc = '".$ifsc."' , holdername = '".$holder_name."' , branchaddress = '".$branch_address."' WHERE sellerid = '".$sellerid."' ");
 	array_push($display_success_message, "Details have been updated successfully<br>");
}
}
 }
?>
 <!DOCTYPE html>
 <html>
 <title>Account Settings</title>
 <head>
      <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <link href="css/style.css" rel="stylesheet">
   <script src="js/jquery.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
           <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
  </head>  

 
  <body>
 <body class="margin-container" >
	<?php include 'includes/header.php'; ?>
      <div class="container">
     
        <div class="row">
            <div class="col-md-12 ">
               <div class="panel panel-primary panel_setting" >
                  <div class="panel-heading panel_heading_height">
                     <span class="glyphicon glyphicon-cog font-icon" aria-hidden="true"> Account Settings</span>&nbsp;&nbsp;&nbsp;
    
                  </div>
				  </div>
				  </div>
	
			  </div>
			  
			 
 <?php if(isset($_GET['msg']) && $_GET['msg']!=""){?>
			  
 <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <center> <strong>Alert:     </strong><?php echo $_GET['msg']; ?></center>
 </div>			  				  
<?php } ?>    

		<form id = "update" action="seller_account1.php" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6 ">
			  			<div class="panel panel-danger">
					      <div class="panel-heading">Personal Settings</div>
					      <div class="panel-body" style="
    margin-bottom: 10px">

					      		<div class="form-group">
								    <label>Name</label>
								  
									 <input name="" type="text" class="form-control" value="<?php echo $ownername; ?>" readOnly>
								</div>
								<div class="form-group">
									<label>Gender</label><br>
								
									 <input name="" type="text" class="form-control" value="<?php echo $gender; ?>" readOnly>
								</div>
								<div class="form-group">
								    <label>D.O.B</label>
								
									 <input name="" type="text" class="form-control" value="<?php echo $dob; ?>" readOnly>
								</div>

								<div class="form-group">
								    <label>Address</label>
								    <textarea class="form-control"  name="sell_address"  ><?php echo $address; ?></textarea>
								</div><br>

								<div class="form-group">
								    <label>Mobile</label>
									 <input name="contact" type="number" class="form-control" value="<?php echo $contact; ?>" >
								  
								</div><br>

								<div class="form-group">
								    <label>Email</label>
								    
								    <input type="email"  name="owner_email" class="form-control" value="<?php echo $email; ?>" >
								    
								</div>
								<br><br>



 <input type="submit" class="btn btn-block btn-danger " value="Update Personal Detail" name="update">
             
					      </div>
						  
					    </div>
						
			  		</div>
			
					  
					
					
					
					
				
			  		<div class="col-md-6 ">
			  			<div class="panel panel-danger">
					      <div class="panel-heading">Store Settings</div>
					      <div class="panel-body" >

					      	<div class="form-group">
								    <label>Store Name</label>
							        <input type="text" class="form-control" value="<?php echo $orgname; ?>" readOnly>
								
								</div>
								<div class="form-group">
									<label>Category</label>
								   
									 <input type="text" class="form-control" value="<?php echo $category; ?>" readOnly>
								</div>
								<div class="form-group">
								    <label>Address</label>
								    <textarea class="form-control"  name = "org_address"  ><?php echo $orgaddress; ?></textarea>
								</div>

								<div class="form-group">
								    <label>Contact</label>
                                
                                  <input type="number" name="contact" class="form-control" value="<?php echo $contact; ?>">								  
								</div>

								<div class="form-group">
								    <label>Email</label>
								   
                                    <input type="email" name="org_email"  class="form-control" value="<?php echo $orgemail; ?>">	
						
								    
								</div>

								<div class="form-group">
								    <label>Website</label>
	
								    <input type="url" name="org_email"  class="form-control" value="<?php echo $siteurl; ?>">	
								    
								</div>

								<div class="form-group">
								    <label>Store Description</label>
								    <textarea class="form-control"  name="org_description"  ><?php echo $description; ?></textarea>
								    
								</div>
 <input type="submit" class="btn btn-block btn-danger " value="Update Store Details" name="update">
             
					      </div>
						  
					    </div>
						
			  		</div>
					
			  	</div>

			  	<div class="row">
					<div class="col-md-6 ">
			  			<div class="panel panel-danger">
					      <div class="panel-heading">Bank Details</div>
					      <div class="panel-body">

					      	<div class="">
								    <label>Account no.</label>
								    <input type="text" class="form-control" name="acc_no" placeholder="<?php echo $acc_no; ?>">
								    
							</div>

							<div class="">
								    <label>IFSC</label>
								    <input type="text" class="form-control" name="ifsc" placeholder="<?php echo $ifsc; ?>">
								    
							</div>

							<div class="">
								    <label>Holder's Name</label>
								    <input type="text" class="form-control" name="holder_name" placeholder="<?php echo $holder_name; ?>">
								    
							</div>

							<div class="form-group">
								    <label>Branch Address</label>
								    <textarea class="form-control"  name="branch_address" placeholder="<?php echo $branch_address; ?> "></textarea>
								    
							</div>
					      		
 <input type="submit" class="btn btn-block btn-danger " value="Update Bank Details" name="update">
             
					      </div>
					    </div>
			  		</div>
    
			  		<div class="col-md-6 ">
			  			<div class="panel panel-danger">
					      <div class="panel-heading">Change Password</div>
					      <div class="panel-body" style="
    margin-bottom: 6px;">

					      	<div class="form-group">
								    <label>Enter Old Password</label>
								    <input type="password" class="form-control" name="old_password" placeholder="">
								    
								    
							</div>

							<div class="form-group">
								    <label>Enter New Password</label>
								    <input type="password" class="form-control" name="new_password" placeholder="">
								    
								    
							</div>

							<div class="form-group">
								    <label>Confirm Password</label>
								    <input type="password" class="form-control" name="confirm_password" placeholder="">
								   
								    
							</div>
							<br><br>
							 <input type="submit" class="btn btn-block btn-danger " value="Confirm" name="update">
            


					      </div>
					    </div>
			  		</div>
			  	</div>
		<div class="row">
		<div class="col-md-6 "></div>
					 <div class="col-md-6 ">
                  <div class="panel panel-danger">
                     <div class="panel-heading">Change Profile Picture</div>
                        <div class="panel-body div-hover" >
                           <?php
                              /*
                                                                                      $sql= "SELECT coverimage FROM org_info";
                                                                                      $result=mysqli_query($con, $sql);
                                                                                      while($row= mysqli_fetch_array($result))
                                                                                          {
                                                                                          echo "<div id= 'img_div'>";
                                  
                                                                                      echo  "<img src='img/org_coverimg/".$row['coverimage']."'>";
                                                                                      echo "<p>".$row['text']."</p>";
                                                                                      echo "</div>";
                                 
                                                                                          } */
                              
                                                                                       ?>
         <form action="seller_account1.php" class="form-group" method="POST">
         <input class="form-control" type='hidden' name='size' value='1000000'>
         <div class="form-group">
         Select image to upload:<input class="form-control" type="file" name="image">
         </div>
		 <input  class ="form-control btn btn-danger" type="submit" value="Change Profile Image" name="upload">
         </form>
         </div>
         </div>
         </div>
		 </div>

               
                                

			
	</div>
<?php include("includes/footer.php"); 
$user_name=$_SESSION['user_name'];
     $sellerid=$_SESSION['sellerid'];
	 ?>
 </body>

 
 </html>
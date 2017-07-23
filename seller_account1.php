<?php
	require ("includes/connect.php");
	//require ("setting_handler.php");
	
	if (isset($_SESSION['user_name'])) {
     $user_name=$_SESSION['user_name'];
     $sellerid=$_SESSION['sellerid'];
     
        $old_password = strip_tags($_POST['old_password']);
        $old_password= md5($old_password);
	$_SESSION['old_password']  = $old_password;
        

	$new_password = strip_tags($_POST['new_password']);
        $new_password1= md5($new_password);
	$_SESSION['new_password']  = $new_password;

	$confirm_password = strip_tags($_POST['confirm_password']);
	$_SESSION['confirm_password']  = $confirm_password;
        


$result = mysqli_query($con,"SELECT ownername , gender , dob , address , mobile , email , bank_details_filled FROM seller_info WHERE sellerid ='".$sellerid."'"); 
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


        //array_push($display_success_message, "");
 //if filling data for the first time
//this might cause an error because initially it is empty but data is getting updated into the database!
if($bank_details_filled == 'no')
{
	$acc_no = strip_tags($_POST['acc_no']); 
 	$_SESSION['acc_no'] = $acc_no;

 	$ifsc = strip_tags($_POST['ifsc']); 
 	$_SESSION['ifsc'] = $ifsc;

 	$holder_name = strip_tags($_POST['holder_name']); 
 	$_SESSION['holder_name'] = $holder_name;

 	$branch_address = strip_tags($_POST['branch_address']); 
 	$_SESSION['branch_address'] = $branch_address;
}
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


 	
$p_check = mysqli_query($con,"SELECT password FROM users WHERE id='$sellerid' and password='$old_password'");
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

 	$sell_mobile = strip_tags($_POST['mobile']);
 	$_SESSION['mobile'] = $sell_mobile;

 	$website = strip_tags($_POST['website']);
 	$_SESSION['website'] = $website;

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
       
        
        $result2=mysqli_query($con,"UPDATE seller_info SET address= '".$sell_address."' , mobile='".$sell_mobile."' , email= '".$sell_email."'  WHERE sellerid='$sellerid'");
        $result3= mysqli_query($con,"UPDATE org_info SET address= '".$store_address."' , contact='".$store_contact."' , email= '".$store_email."', siteurl='".$website."', description='".$descrip."' WHERE sellerid='$sellerid'"); 
	
if($num_rows4 == 0)
 	{
 		array_push($error_array, "Incorrect Password!!<br>");
                
 	}
        else{
            
         $result = mysqli_query($con,"UPDATE users SET password ='$new_password1' WHERE password='$old_password'");
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
     <style>
        
     </style>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/modal.css" rel="stylesheet" type="text/css"  media="all" />
        <!-- Custom CSS -->
       
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

  </head>
 
  <body>
      <?php include 'includes/header.php'; ?>
<center><h3>Account Settings</h3></center>
 


		<form id = "update" action="seller_account1.php" method="POST" enctype="multipart/form-data">
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
								    <textarea class="form-control"  name="contact"  ><?php echo $contact; ?></textarea>
								</div><br>

								<div class="form-group">
								    <label>Email</label>
								     <textarea class="form-control"  name="owner_email"  ><?php echo $email; ?></textarea>
								    
								    
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
                                                                        <textarea class="form-control"  name="contact"  ><?php echo $contact; ?></textarea>								    
								</div>

								<div class="form-group">
								    <label>Email</label>
								     <textarea class="form-control"  name="org_email"  ><?php echo $orgemail; ?></textarea>

						
								    
								</div>

								<div class="form-group">
								    <label>Website</label>
								    <textarea class="form-control"  name="website"  ><?php echo $siteurl; ?></textarea>
								    
								    
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
								    <input type="text" class="form-control" name="acc_no" placeholder="<?php echo $acc_no; ?>">
								    
							</div>

							<div class="form-group">
								    <label>IFSC</label>
								    <input type="text" class="form-control" name="ifsc" placeholder="<?php echo $ifsc; ?>">
								    
							</div>

							<div class="form-group">
								    <label>Holder's Name</label>
								    <input type="text" class="form-control" name="holder_name" placeholder="<?php echo $holder_name; ?>">
								    
							</div>

							<div class="form-group">
								    <label>Branch Address</label>
								    <textarea class="form-control"  name="branch_address" placeholder="<?php echo $branch_address; ?> "></textarea>
								    
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
								    
								    
							</div><br>

							<div class="form-group">
								    <label>Enter New Password</label>
								    <input type="password" class="form-control" name="new_password" placeholder="">
								    
								    
							</div><br>

							<div class="form-group">
								    <label>Confirm Password</label>
								    <input type="password" class="form-control" name="confirm_password" placeholder="">
								   
								    
							</div>
							<br><br>


					      </div>
					    </div>
			  		</div>
			  	</div>

			  	<div class="row">
                                   
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
						      <div class="panel-body">
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
                                 
                                                          		    
                                                          <input type='hidden' name='size' value='1000000'>
                                                <div>
                                                    Select image to upload:<input type="file" name="image">
                                                    <input  class ="form-control btn btn-success" type="submit" value="Change Cover Image" name="upload">
                                             
                                               </div>
                                                         </form>
                                                      
                                                           

								

      
								   

						      </div>
					    </div>
					</div>
                                        </div>
                                
					
					<div class=" col-md-offset-2 col-md-2">
				 <input type="submit" class="btn btn-block btn-success " value="Update" name="update">
				 <?php if(in_array("Details have been updated successfully<br>", $display_success_message))  echo "Details have been updated successfully<br>";
						 ?>
				 </div>
			  		
                                </div>
                    <br>
                    <br>
                    <br>
                    <br>
                                

			
	
<?php include("includes/footer.php"); 
$user_name=$_SESSION['user_name'];
     $sellerid=$_SESSION['sellerid'];?>
 </body>

 
 </html>
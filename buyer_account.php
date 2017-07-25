<?php
   require ("includes/connect.php");
   //require ("setting_handler.php");
   $buyerid=$_SESSION['buyerid'];
          $buyer_user_name=$_SESSION['buyer_user_name'];
          $result = mysqli_query($con,"SELECT * FROM buyer_info WHERE buyerid ='".$buyerid."'"); 
          
   $row=mysqli_fetch_array($result);
   $buyername = $row['buyername'];
   $gender = $row['gender'];
   $contact = $row['contact'];
   $address = $row['address'];
   $msg="";
   $email = $row['email']; 
   $profilepic=$row['profilepic'];
   
   
   
   $display_success_message = array();
   $error_array= array();
   if (isset($_SESSION['buyer_user_name'])) {
       $buyer_user_name=$_SESSION['buyer_user_name'];
       $buyerid=$_SESSION['buyerid'];
       

    
       if(isset($_POST['old_password'])){
          $old_password = strip_tags($_POST['old_password']);
          $old_password= md5($old_password);
       $_SESSION['old_password']  = $old_password;
          }
   if(isset($_POST['new_password'])){
   
   $new_password = strip_tags($_POST['new_password']);
          $new_password1= md5($new_password);
   $_SESSION['new_password']  = $new_password;
   }
   if(isset($_POST['confirm_password'])){
   $confirm_password = strip_tags($_POST['confirm_password']);
          $_SESSION['confirm_password']  = $confirm_password;
   }       
          if(isset($_POST['upload'])){
               $target = "img/buyer_img/".basename($_FILES['image']['name']);
          $buyer_img= $_FILES['image']['name'];
          $_SESSION['buyer_img']= $buyer_img;
          move_uploaded_file($_FILES['image']['tmp_name'], $target); 
                  $result4= mysqli_query($con,"UPDATE buyer_info SET profilepic='".$buyer_img."' WHERE buyerid='$buyerid'"); 
				  $msg="Profile Picture Updated";
          }
          
          if(isset($_POST['update'])){
          
   
   	$buyer_email = strip_tags($_POST['buyer_email']); 
   	$_SESSION['buyer_email'] = $buyer_email;
   
          $buyer_name= strip_tags($_POST['buyer_name']);
          $_SESSION['buyer_name']=$buyer_name;
   	
          $gender = strip_tags($_POST['gender']); 
     	$_SESSION['gender'] = $gender;
   
   	$buyer_address = strip_tags($_POST['buy_address']);
   	$_SESSION['buy_address'] = $buyer_address;
   
   	$buyer_contact = strip_tags($_POST['contact']);
   	$_SESSION['contact'] = $buyer_contact;
   
   if((mysqli_num_rows($result)>0)){
          
           $result2=mysqli_query($con,"UPDATE buyer_info SET buyername='".$buyer_name."' , address= '".$buyer_address."' , contact='".$buyer_contact."' , email= '".$buyer_email."' , gender='".$gender."' WHERE buyerid='$buyerid'");
          $msg=" profile updated successfully";
		  }
   if((mysqli_num_rows($result))==0) {
        		$result3 =mysqli_query($con,"INSERT INTO buyer_info VALUES ('".$buyerid."','".$buyer_email."','".$buyer_name."','".$buyer_contact."','".$buyer_address."','".$gender."',' ')");
     
	   $msg="Password Changed Successfully";
   }
          $p_check = mysqli_query($con,"SELECT password FROM buyer_users WHERE buyerid='$buyerid'");
          
          $num_rows4 = mysqli_num_rows($p_check); 
          
          
          if($num_rows4 == 0)
   	{
   		array_push($error_array, "Incorrect Password!!<br>");
                  
   	}
          else{
              
           $result4 = mysqli_query($con,"UPDATE buyer_users SET password ='$new_password1' WHERE buyerid='$buyerid'");
 $msg=" profile updated successfully";
		 }
   	if ($new_password!=$confirm_password) {
   
   		array_push($error_array, "Passwords dont match!!<br>");
   	}
          }
          
          
          
          ?>
<!DOCTYPE html>
<html>
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
    
	<?php include 'includes/header.php'; ?>
   <body class="margin-container" >

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
			  <?php if(isset($msg)){
				     
			      
			  ?>
			  
 <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <center> <strong>Alert: </strong><?php echo $msg; ?></center>
   </div>			  				  
				  <?php } ?>    
			  <br>
		  
         <form id = "update" action="buyer_account.php" method="POST" enctype="multipart/form-data">
            <div class="row">
               <div class="col-md-6 ">
                  <div class="panel panel-danger">
                     <div class="panel-heading">Change Personal Detail</div>
                     <div class="panel-body div-hover">
                        <div class="form-group">
                           <label>UserName</label>
						   
                           <input type="text" class="form-control" value="<?php echo $buyer_user_name; ?>" readOnly>
                        </div>
                        <div class="form-group">
                           <label>Name</label>
                           <input type="text" class="form-control" name="buyer_name" value="<?php echo $buyername; ?>">
                        </div>
                        <div class="form-group">
                           <label>Gender</label><br>
                           <input class="form-control" name="gender" value="<?php echo $gender; ?>">
                        </div>
                        <div class="form-group">
                           <label>Address</label>
                           <input class="form-control"  name="buy_address" value="<?php echo $address; ?>" >
                        </div>
                    
                        <div class="form-group">
                           <label>Mobile</label>
                           <input class="form-control"  name="contact" value="<?php echo $contact; ?>" >
                        </div>
                      
                        <div class="form-group">
                           <label>Email</label>
                           <input class="form-control"  name="buyer_email" value="<?php echo $email; ?>" >
                        </div>
                        <input type="submit" class="btn btn-block btn-danger " value="Update Personal Detail" name="update">
             
                     </div>
                  </div>
				 
				    </div>
			  
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
     
         <div class="col-md-6">
         <div class="panel panel-danger ">
         <div class="panel-heading">Change Password</div>
         <div class="panel-body div-hover" >
         <div class="form-group">
         <label>Enter Old Password</label>
         <input type="password" class="form-control" name="old_password" placeholder="">
         <?php //if(in_array("Incorrect Password!!<br>", $error_array))  echo "Incorrect Password!!<br>";?>
         </div>
         <div class="form-group">
         <label>Enter New Password</label>
         <input type="password" class="form-control" name="new_password" placeholder="">
         </div>
         <div class="form-group">
         <label>Confirm Password</label>
         <input type="password" class="form-control" name="confirm_password" placeholder="">
         <?php if(in_array("Passwords dont match!!<br>", $error_array))  echo "Passwords dont match!!<br>";?>
         </div>
  <input onclick="return confirm('Are you sure?')"  type="submit" class="btn btn-block btn-danger " value="Update Password" name="update" style="margin-top:42px">
         <?php if(in_array("Details have been updated successfully<br>", $display_success_message))  echo "Details have been updated successfully<br>";
            ?>
         </div>
         </div>

		 
         </div>
      
         </div>
		 <br>		 <br>
         
      </div>
	  <?php include'includes/footer.php';
            ?>
   </body>
</html>
<?php } ?>
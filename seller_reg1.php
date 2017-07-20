<?php

require 'includes/connect.php';
require 'register_handler.php';

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

<div class="container"style="margin-top:50px;">
  <div class="row">
	  <div class="text-center">
	  <h2>Seller Registration</h2>
	  </div>
	   <form class="form-horizontal" id = "sell_reg" action="seller_reg1.php" method="POST" enctype="multipart/form-data">





  
	  <div class="col-sm-6 div-hover">
		  <h3 class="well text-center">Store Details</h3>
		  <br>
		   <div class="row">
		  <div class=" col-sm-3">
	   <label class="control-label " >Store Name:</label>
		  </div>
		   <div class=" col-sm-8">
					
			  		     <input type="text" class="form-control zero-left form-group"  placeholder="Enter Store Name.." name="store_name"
			        value="<?php 
						if(isset($_SESSION['store_name'])) {
							echo $_SESSION['store_name'];
							} 
							?>" required>
		  </div>
	  </div>







   <div class="row">
		  <div class=" col-sm-3">
	  	<label class="control-label  " >Category:</label>
		  </div>
		   <div class=" col-sm-8">
					 <input type="text" class="form-control zero-left form-group" id="category" placeholder="" name="category" value="<?php 
						if(isset($_SESSION['category'])) {
							echo $_SESSION['category'];
							} 
							?>" required>
		  </div>
	  </div>



   <div class="row">
		  <div class=" col-sm-3">
	   <label class="control-label  ">Store Address:</label>
		  </div>
		   <div class=" col-sm-8">
				 	<textarea class="form-control zero-left form-group" rows="2"  name="org_address"  required></textarea>
		  </div>
	  </div>


        <div class="row">
		  <div class=" col-sm-3">
	     <label class="control-label ">Contact:</label>
		  </div>
		   <div class=" col-sm-8">
			<input name="contact" placeholder="Enter 10 digits" class="form-control zero-left form-group" type="text" value="<?php 
						if(isset($_SESSION['contact'])) {
							echo $_SESSION['contact'];
							} 
							?>"
			  			required>
			  			<?php if(in_array("Enter a valid 10 digit contact no.<br>", $error_array))  echo "Enter a valid 10 digit contact no.<br>";
						 ?>
		  </div>
	  </div>


	    <div class="row">
		  <div class=" col-sm-3">
	  
			      <label class="control-label   ">Store Email:</label>
		  </div>
		   <div class=" col-sm-8">
			<input name="org_email" placeholder="xyz@gmail.com" class="form-control zero-left form-group" type="text"
			  			value="<?php 
						if(isset($_SESSION['org_email'])) {
							echo $_SESSION['org_email'];
							} 
							?>" required>
							<br>
						<?php if(in_array("This Email already in use<br>", $error_array))  echo "This Email already in use<br>";
						 else if(in_array("INAVLID FORMAT!<br>", $error_array))  echo "INAVLID FORMAT!<br>";?>
		  </div>
	  </div>



	    <div class="row">
		  <div class=" col-sm-3">
	  
		 <label class="control-label    ">Website:</label>
		  </div>
		   <div class=" col-sm-8">
		 <input type="url" name="website" class="form-control zero-left form-group" placeholder="e.g. www.xyz.com" value="<?php 
						if(isset($_SESSION['website'])) {
							echo $_SESSION['website'];
							} 
							?>" required >
							<?php if(in_array("This website is already in use<br>", $error_array))  echo "This website is already in use<br>";?>

		  </div>
	  </div>


	    <div class="row">
		  <div class=" col-sm-3">
	  
              <label class="control-label ">Cover image:</label>
		  </div>
		   <div class=" col-sm-8">
	
			  			<input type='hidden' name='size' value='1000000' >
                                                <div>
                                             Select image to upload:<input type="file" name="image" class="form-control zero-left form-group">
                                             
                                               </div>
		  </div>
	         </div>





       <div class="row">
		  <div class=" col-sm-3">
	  

			    <label class="control-label">Description:</label>
		  </div>
		   <div class=" col-sm-8">
	
			  		<input type="text" class="form-control zero-left form-group" name="org_description" placeholder="About your store"  required>
		  </div>
	     </div>

</div>
<!-- mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm -->
	
	  <div class="col-sm-6 div-hover" style="padding-bottom: 65px;">
		  <h3 class="well text-center">Personal Details</h3>
		  <br>
		  <div class="row">
		  <div class="col-sm-3">
			    <label class="control-label " >Owner Name:</label>
		  </div>
		   <div class="col-sm-8">
			           <input type="text" class="form-control zero-left form-group"  placeholder="Enter Owner's Name.." name="owner_name" value="<?php 
						if(isset($_SESSION['owner_name'])) {
							echo $_SESSION['owner_name'];
							} 
							?>" required>
		  </div>
		  </div>


		    <div class="row">
		  <div class=" col-sm-3">
			 <label class="control-label " >Gender:</label>
		  </div>
		   <div class=" col-sm-8">



                 <div class="radio">
                    <input checked id="male" name="gender" value="Male" type="radio" class="radio-inline">
                     <label for="male" class="radio-label">Male </label> 
                  </div>
             
                

               
                  <div class="radio">
                    <input id="female" name="gender" value="Female" type="radio" class="radio-inline">
                    <label for="female" class="radio-label ">Female</label>
				  </div>
				  


				   <div class="radio">
                    <input id="other" name="gender" value="Other" type="radio" class="radio-inline">
                    <label for="other" class="radio-label ">Other</label>
                  </div>
              
		  </div>


		  </div>

<br>
		    <div class="row">
		  <div class=" col-sm-3">
	 <label class="control-label">D.O.B:</label>
		  </div>
		   <div class=" col-sm-8">
			        	<input type="date" class="form-control zero-left form-group"  name="dob" placeholder="Date of Birth"  required>
		  </div>
		  </div>



		  	    <div class="row">
		  <div class=" col-sm-3">
	      <label class="control-label">Address:</label>
		  </div>
		   <div class=" col-sm-8">
			<textarea class="form-control zero-left form-group" rows="2" name="sell_address"  required></textarea>
		  </div>
		  </div>





		  	    <div class="row">
		  <div class=" col-sm-3">
	    <label class="control-label">Mobile:</label>
		  </div>
		   <div class=" col-sm-8">
					<input name="mobile" placeholder="Enter 10 digits" class="form-control zero-left form-group" type="text" 
			  	   value="<?php 
						if(isset($_SESSION['mobile'])) {
							echo $_SESSION['mobile'];
							} 
							?>"	required>
							<?php if(in_array("Enter a valid 10 digit mobile no.<br>", $error_array))  echo "Enter a valid 10 digit mobile no.<br>";
						 ?>
		  </div>
		  </div>



		    <div class="row">
		  <div class=" col-sm-3">
	    <label class="control-label">Email:</label>
		  </div>
		   <div class=" col-sm-8">
					
			  			<input name="owner_email" placeholder="xyz@gmail.com" class="form-control zero-left form-group" type="text"
			  			value="<?php 
						if(isset($_SESSION['owner_email'])) {
							echo $_SESSION['owner_email'];
							} 
							?>" required>
							<br>
						<?php if(in_array("This Email already in use<br>", $error_array))  echo "This Email already in use<br>";
						 else if(in_array("INAVLID FORMAT!<br>", $error_array))  echo "INAVLID FORMAT!<br>";?>
		 
		 
		 
		 
		 </div>
		   </div>  
		   
		   	     <div class="col-sm-3"  style="float:right;margin-right:20px">
			 
				 </div> 
			

				</div> 

		  </div>
		        
			  	 <center>
<input type="submit" class="btn btn-primary " value="Next" name="sell_reg" style="width:200px;margin-top:30px">
</center>
		      
				
	</form>






















			  

		

</div>

<br><br><br><br><br><br
<?php include ("includes/footer.php") ?>
</body>

</html>

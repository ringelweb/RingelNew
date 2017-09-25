<?php

echo "<script type='text/javascript'>alert('1');</script>";
$sell_name = "";
$store_name = "";
$gen = "";
$cat = "";
$dob = "";
$store_address = "";
$sell_address = "";
$store_contact = "";
$sell_mobile = "";
$store_email = "";
$sell_email = "";
$website = "";
$descrip = "";
$cover_img = "";
$error_array = array();
echo "<script type='text/javascript'>alert('2');</script>";
if(isset($_POST['sell_reg'])){
echo "<script type='text/javascript'>alert('3');</script>";
	$sell_name = strip_tags($_POST['owner_name']); 
 	$_SESSION['owner_name'] = $sell_name; 

 	$store_name = strip_tags($_POST['store_name']); 
 	
 	$_SESSION['store_name'] = $store_name;

 	//email
 	$store_email = strip_tags($_POST['org_email']); 
 	 
 	$_SESSION['org_email'] = $store_email;

 	$sell_email = strip_tags($_POST['owner_email']); 
	
 	$_SESSION['owner_email'] = $sell_email;
echo "<script type='text/javascript'>alert('$sell_email');</script>";

 	$gen = $_POST['gender'];
 	$_SESSION['gender'] = $gen;

 	$cat = strip_tags($_POST['category']);
 	$_SESSION['category'] = $cat;

 	$dob = $_POST['dob'];
 	$_SESSION['dob'] = $dob;

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
        
        $target = "img/org_coverimg/".basename($_FILES['image']['name']);
        $cover_img= $_FILES['image']['name'];
        $_SESSION['cover_img']= $cover_img;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

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
 	/*	else
 		{ echo "<script type='text/javascript'>alert('4');</script>";

 			array_push($error_array, "INAVLID FORMAT!<br>");
 		}
*/
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
 	}

 	$w_check = mysqli_query($con,"SELECT siteurl FROM org_info WHERE siteurl='$website'");

 			//count the no. of rows returned

 			$num_rows3 = mysqli_num_rows($w_check);

 			if($num_rows3 > 0)
 			{
 				array_push($error_array, "This website is already in use<br>");
 			}

 		if(empty($error_array)) {
 		

 		

 		//Profile picture assignment
 		

 		
 		
 		//$query =mysqli_query($con,"INSERT INTO seller_info VALUES ('','$sell_name','$gen','$dob','$sell_address','$sell_mobile','$sell_email', 'no')");
 		//$query2 = mysqli_query($con,"INSERT INTO org_info VALUES ('','$store_name','$cat','$store_address','$store_contact','$store_email','$website','$cover_img','$descrip')");
		
		
		$query1 ="INSERT INTO seller_info(ownername,gender,dob,address,mobile,email,bank_details_filled) VALUES ('$sell_name','$gen','$dob','$sell_address','$sell_mobile','$sell_email', 'no')";
		$result1=mysqli_query($con, $query1) or die(mysqli_error($con));
		
		$query2 ="INSERT INTO org_info(orgname,category,address,contact,email,siteurl,coverimage,description) VALUES ('$store_name','$cat','$store_address','$store_contact','$store_email','$website','$cover_img','$descrip')";
		$result2=mysqli_query($con, $query2) or die(mysql_error($con));
		
 		header("Location: seller_reg2.php");


 		//clear session variables
 		$_SESSION['owner_name'] = "";
 		$_SESSION['store_name'] = $store_name;
 		$_SESSION['org_email'] = "";
 		$_SESSION['owner_email'] = "";
 		$_SESSION['gender'] = "";
 		$_SESSION['category'] = "";
 		$_SESSION['dob'] = "";
 		$_SESSION['org_address'] = "";
 		$_SESSION['sell_address'] = "";
 		$_SESSION['contact'] = "";
 		$_SESSION['mobile'] = "";
 		$_SESSION['website'] = "";
 		$_SESSION['org_description'] = "";
               
 	}




















	}


?>
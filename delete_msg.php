<?php

   require 'includes/connect.php';
   $msg="";
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $msg_id = $_GET["id"]; 
    //$user_id = $_SESSION['user_id'];
    
    // Delete the rows from pvt_msgs table 
    $query = "DELETE FROM pvt_msgs WHERE msgid='$msg_id'  ";
    $res = mysqli_query($con, $query) or die($mysqli_error($con));
	
	 if (isset($_SESSION['buyer_user_name'])){
	 header("location:msg_buyer.php");}
	 
	 if (isset($_SESSION['user_name'])){
		
		 header("location:msg.php");}
		
}
?>



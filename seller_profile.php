<?php

require 'includes/connect.php';
//$user_name=$_SESSION['user_name'];
//$sellerid=$_SESSION['sellerid'];
//$sellerid=$_SESSION['sellerid'];
$buyer_user_name=$_SESSION['buyer_user_name'];
$buyerid=$_SESSION['buyerid'];


 //Declaring variables to prevent error
/*if(!isset($_SESSION['user_name']))
{
    header('Location: index.php');
}*/


if(empty($_GET)) {
$query="SELECT orgname,address,coverimage,siteurl,contact,email,description FROM org_info WHERE sellerid='".$sellerid."'";
$result= mysqli_query($con, $query);
 $row= mysqli_fetch_array($result);
 //logic to display the posts from product_info table 
 //only recent 6 are shown

 $post_query = "SELECT productimage FROM product_info  WHERE sellerid='".$sellerid."' " ;
 $result_post_query = mysqli_query($con, $post_query);
 //$row_post_query = mysqli_fetch_array($result_post_query);
	$img = array("","","","","","");//array to store 6 posts into the post area
	$i = 0;

 while ($row2 = mysqli_fetch_array($result_post_query,MYSQLI_ASSOC))
{
     $temp = $row2["productimage"];
     $img[$i++] = $temp;
     //echo $temp;
}}
else {
    $id=$_GET['id'];
    $insert=FALSE;
    $check=mysqli_query($con,"SELECT * FROM seller_follow WHERE buyerid='".$buyerid."' and sellerid='".$id."'");
    $num= mysqli_num_rows($check);
    if($num==0){
        $insert=FALSE;
        
    }
    else{
        $insert=TRUE;
    }
   
    $query="SELECT orgname,address,coverimage,siteurl,contact,email,description FROM org_info WHERE sellerid='".$id."'";
$result= mysqli_query($con, $query);
 $row= mysqli_fetch_array($result);
 //logic to display the posts from product_info table 
 //only recent 6 are shown

 $post_query = "SELECT productimage FROM product_info  WHERE sellerid='".$id."' " ;
 $result_post_query = mysqli_query($con, $post_query);
 //$row_post_query = mysqli_fetch_array($result_post_query);
	$img = array("","","","","","");//array to store 6 posts into the post area
	$i = 0;

 while ($row2 = mysqli_fetch_array($result_post_query,MYSQLI_ASSOC))
{
     $temp = $row2["productimage"];
     $img[$i++] = $temp;
     //echo $temp;
}
 if(isset($_POST['follow'])){
               $check=mysqli_query($con,"SELECT * FROM seller_follow WHERE buyerid='".$buyerid."' and sellerid='".$id."'");
               if(mysqli_num_rows($check)==0){
               $query="INSERT INTO seller_follow VALUES('','".$id."','".$buyerid."')";
               $insert=mysqli_query($con,$query);
              
               
               }
            
               
}   if(isset($_POST['following'])){
                
               $check=mysqli_query($con,"SELECT * FROM seller_follow WHERE buyerid='".$buyerid."' and sellerid='".$id."'");
               $num1=mysqli_num_rows($check);
               if($num1>0){
               $query1="DELETE FROM seller_follow WHERE buyerid='".$buyerid."' and sellerid='".$id."'";
               $result= mysqli_query($con,$query1);
               $insert=FALSE;
               }
               
               } 
$follow_result= mysqli_query($con,"SELECT * FROM seller_follow WHERE sellerid='".$id."'");
$num_follow= mysqli_num_rows($follow_result);
}


 
          



?>




<!DOCTYPE html>
 <html>
 <title>Account Settings</title>
 <head>

 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/seller_profile.css">

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
       <style type="text/css">
       	.notification_badge {
	padding: 3px 7px;
	font-size: 12px;
	font-weight: 700;
	line-height: 1;
	color: #fff;
	text-align: center;
	white-space: nowrap;
	vertical-align: baseline;
	background-color: #F00;
	border-radius: 10px;
	position: absolute;
	left: 8px;
	top: -5px;
}
       </style>
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

  </head>
  <body>
      <?php include 'includes/header.php';
     // $user_name=$_SESSION['user_name'];
    // $sellerid=$_SESSION['sellerid'];
     $buyer_user_name=$_SESSION['buyer_user_name'];
     $buyerid=$_SESSION['buyerid'];?>
  	<div class="container margin-container">
  		 <?php


								        	
								        	if(isset($_POST['message_submit']))
								        	{
								        		$message_to = $_POST['buyer_name'];
								        		$message_body = $_POST['comment_body'];

								        		
								        		$query = "SELECT * from buyer_users WHERE username = '".$message_to."' ";
								        		$run_query = mysqli_query($con,$query);

								        		if(mysqli_num_rows($run_query) == 0)
								        			{
								        				?>
								        				<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Warning:</strong> Please check and Enter again. Buyer not found in our database!
</div>
													<?php
													
								        			}
								        		else
								        		{	

								        		

								        		$query = "INSERT INTO pvt_msgs(_to, _from, message, _read) VALUES ('".$message_to."','".$user_name."','".$message_body."', 'no')";
								        		$insert_message = mysqli_query($con,$query);

								        		
								        		?>
								        				<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success:</strong> Message sent successfully!
</div>
													<?php
											
								        		}
								        	}

								        	//
								        ?>
  	<div class="row">
            <?php if(empty($_GET)) { ?>
		<div class="col-md-12 ">
	  			<div class="panel panel-primary panel_setting" >
				      <div class="panel-heading panel_heading_height">
				      <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;
				      <label id="profile_label">Profile</label></div>
					      <div class="panel-body">

					      	
								    	<div class="col-sm-offset-6 col-md-2">
								    		
								    			<button class="btn btn-success btn-block">
								    			<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
								    			See Orders</button>
								    			
								    		
								    	</div>

								    	<div class="col-md-2">
								    		<button class="btn btn-success btn-block" data-toggle="modal" data-target="#send_message">
								    		<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
								    		 Send Message</button>

								        <!-- Clicking review button above launches comment modal -->
								            <div id="send_message" class="modal fade" role="dialog">
								            <div class="modal-dialog">

								             
								              <div class="modal-content">
								                <div class="modal-header">
								                  <button type="button" class="close" data-dismiss="modal">&times;</button>
								                  <h4 class="modal-title">Add your Message here!!</h4>
								                </div>
								                <div class="modal-body">
								                <!--  form starts here-->
								                <form id = "message_form" action="" method="POST" enctype="multipart/form-data">
								                  <div class="form-group">
								                    <input type="text" name="buyer_name" placeholder="Enter buyer name to send Message to..." required >
								                  </div>

								                  <div class="form-group">
								                    <textarea class="form-control" name="comment_body" placeholder="your comment goes here..." required></textarea>
								                  </div>
								                  <input type="submit" class="btn btn-block btn-success" value="submit" name="message_submit" >
								                  <!--  form ends here-->
								                </form>
								                <!-- logic to insert comment-->
								                 

								                </div>
								                
								              </div>

								            </div>
								          </div>

								        <!--End of comment modal -->
								       
								    	</div>
										<?php

										

										?>
										<div class="col-md-2">
								    		<button class="btn btn-success btn-block" data-toggle="modal" data-target="#check_inbox" >
								    		<span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
								    		View Inbox
								    		<?php

								    			$query_notif = "SELECT * FROM pvt_msgs WHERE _to = '".$user_name."' ";
										if($run_query_notif = mysqli_query($con,$query_notif))
											{

												$no_of_unread_messages = mysqli_num_rows($run_query_notif);


										    }

										    $query_notif_badge = "SELECT * FROM pvt_msgs WHERE _to = '".$user_name."' AND  _read = 'no' ";
										if($run_query_notif_badge = mysqli_query($con,$query_notif_badge))
											{

												$no_of_unread_messages_badge = mysqli_num_rows($run_query_notif_badge);


										    }
										    
										    if($no_of_unread_messages_badge > 0)
								    		 	echo '<span class="notification_badge" id="unread_message">'."$no_of_unread_messages".'</span>'; ?>
								    		</button>
								    		 <div id="check_inbox" class="modal fade" role="dialog">
								            <div class="modal-dialog">

								             
								              <div class="modal-content">
								                <div class="modal-header">
								                  <button type="button" class="close" data-dismiss="modal">&times;</button>
								                  <h4 class="modal-title">Your Inbox!</h4>
								                </div>
								                <div class="modal-body">
								                <!--  form starts here-->
								               
								                 <?php
								                 	while($row_messages = mysqli_fetch_array($run_query_notif))
								                 		{

								                 		?>
								                 		<div class="panel panel-warning">
													      <div class="panel-heading"><strong>From:</strong> <?php echo $row_messages['_from'];

													       ?>
													      </div>
													      <div class="panel-body">
													      	<div class="dropdown">
															 <button class="btn btn-info dropdown-toggle" id ="message_drop" name = "dropdown_button" method="POST" type="button" data-toggle="dropdown">See Message
															  <span class="caret"></span></button>

															 	<ul class="dropdown-menu" >
															    <li><?php echo $row_messages['message'];
															    	
															    //$msgid = $row_messages['msgid'];
															    $msgid = $row_messages['msgid'];
															    $update_query = "UPDATE pvt_msgs SET _read= 'yes' WHERE msgid = '".$msgid."' ";
															    $run_query_update = mysqli_query($con,$update_query);

															     ?></li>
																<button class="btn btn-success"><a href="seller_profile.php">Mark as read!</a></button>
															  </ul>
															  
													 
															</div> 
													      </div>
													    </div>
													    <?php


															  
													    			}



													    ?>

													   

								                </div>

								                
								              </div>

								            </div>
								          </div>


								    	</div>
								




					      </div>
			    </div>
                                                </div> <?php } ?>
  		</div>
  		<br>
  		<div class="row">
  		<div class="col-md-8 ">
	  			<div class="panel panel-info panel_setting" >
				      
					      <div class="panel-body">

					      	
								    	<div class="col-md-3">
								    			<button class="btn btn-info btn-block">
								    			<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
								    			views
								    			</button>
								    				
								    	</div>

								    	<div class=" col-md-offset-1 col-md-3">
								    		<button class="btn btn-warning btn-block">
								    		<span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
								    		Products</button>
								    	</div>

								    	  <?php     if(!empty($_GET)&&($insert==FALSE)) {   ?>
								    	<div class=" col-md-offset-1 col-md-3">
                                                                           
                                                                            <form action="seller_profile.php?id=<?php echo $id;?>" method="post">
                                                                                <input type="submit" class="btn btn-block btn-info" value="Follow (<?php echo $num_follow; ?>)"  name="follow">
                                                                            </form>
                                                                            
								    	</div>
                                                                   <?php } else if(empty($_GET)){ ?>
                                                  <div class=" col-md-offset-1 col-md-3">
                                                                                
								    		<button class="btn btn-info btn-block">
								    		<span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>
								    		See Followers</button>
								    	</div>
                                                                   <?php } ?>
                                                   <?php   if(!empty($_GET)&&($insert==TRUE)){ ?>
                                                  <div class=" col-md-offset-1 col-md-3">
                                                                                <form action="seller_profile.php?id=<?php echo $id;?>" method="post">
                                                                                <input type="submit" class="btn btn-block btn-info" value=" <?php echo $num_follow; ?>  Following"  name="following">
                                                                            </form>
								    	</div>
                                                                   <?php } ?>
								
								
								



					      </div>
			    </div>
  		</div>

  		<div class="col-md-4">

  			<div class="panel panel-info panel_setting" >
				      
					      <div class="panel-body">

					      	
								    	<label>Store Image</label>
								    	<!--<img src="img/product_img/coder.jpg" height="100px">-->
								    	<div class="row">
										  <div class="col-xs-6 col-md-6">
										    <a href="#" class="thumbnail">
										      <img src="<?php echo "img/org_coverimg/".$row['coverimage'].""; ?>" height="100px">
										    </a>
										    
										  </div>
										  
										</div>
																		




					      </div>
			    </div>
  			
  		</div>

  		</div>
  		<br>

  		<div class="row">
			
			<?php if(empty($_GET)){ ?>
			<div class="col-md-8">
                            
				<div class="well well-lg" >
				   <a href="postproduct.php"><button class="btn btn-warning btn-block" >
								    		<span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>
								    		Add a Product</button></a>
					      
			    </div>

			</div> 
                        <?php } ?>

			<div class="col-md-4">

				<div class="well well-lg" >
				   <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
				   <label>Store Name:</label>
				   <?php echo $row['orgname']; ?>
			    </div>

			</div>  	 			
  		</div>

  		<div class="row">
  			<div class="col-md-8">
  				<div class="well well-lg shared_post">
  				<center><label>Posts:</label></center>
  					<div class="row">

						  <div class="col-xs-6 col-md-4">
						    <a href="#" class="thumbnail">
						     	<img src="<?php echo "img/product_img/".$img[0].""; ?>" alt = "No More Posts" height="100px">
						    </a>
						    
						  </div>

						  <div class="col-xs-6 col-md-4">
						    <a href="#" class="thumbnail">
						      <img src="<?php echo "img/product_img/".$img[1].""; ?>" alt = "No More Posts" height="100px">
						    </a>
						    
						  </div>

						  <div class="col-xs-6 col-md-4">
						    <a href="#" class="thumbnail">
						      <img src="<?php echo "img/product_img/".$img[2].""; ?>" alt = "No More Posts" height="100px">
						    </a>
						    
						  </div>
										  
					</div>

					<div class="row">
						  <div class="col-xs-6 col-md-4">
						    <a href="#" class="thumbnail">
						      <img src="<?php echo "img/product_img/".$img[3].""; ?>" alt = "No More Posts" height="100px">
						    </a>
						    
						  </div>

						  <div class="col-xs-6 col-md-4">
						    <a href="#" class="thumbnail">
						      <img src="<?php echo "img/product_img/".$img[4].""; ?>" alt = "No More Posts" height="100px">
						    </a>
						    
						  </div>

						  <div class="col-xs-6 col-md-4">
						    <a href="#" class="thumbnail">
						      <img src="<?php echo "img/product_img/".$img[5].""; ?>" alt = "No More Posts" height="100px">
						    </a>
						    
						  </div>
										  
					</div>

  				</div>
  				
  			</div>

  			<div class="col-md-4">
  				<div class="well well-lg store_intro">
  				<center><label>Store Intro:</label>
  				<br>
  				<?php echo $row['description']; ?>
  				
  				</center>
  					

					

  				</div>
  				 <?php if(empty($_GET)) { ?>
  				<a href="seller_account1.php"><button class="btn btn-danger btn-block">
								    		<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
								    		Account Setting</button></a>
                            <?php } ?>
  				
  			</div>


  		</div>



  	</div>
      <?php 
    //  $user_name=$_SESSION['user_name'];
   //  $sellerid=$_SESSION['sellerid'];
       $buyer_user_name=$_SESSION['buyer_user_name'];
     $buyerid=$_SESSION['buyerid'];?>

  	</body>
  	</html>

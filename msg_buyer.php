<?php

require 'includes/connect.php';
   $buyer_user_name=$_SESSION['buyer_user_name'];
   $buyerid=$_SESSION['buyerid'];



														 
															
   if(isset($_POST['message_submit']))
   			        	{
   			        	    if (isset($_SESSION['msg_to'])) {
                            $message_to=$_SESSION['msg_to'];
   			  }
   			        		$message_body = $_POST['comment_body'];
                          if (isset($_SESSION['user_name'])) {
                            $user_name=$_SESSION['user_name'];
   			  }
   			      
   echo $message_to;
   $query = "INSERT INTO pvt_msgs(_to, _from, message, _read) VALUES ('".$message_to."','".$user_name."','".$message_body."', 'no')";
   $insert_message = mysqli_query($con,$query) or die(mysqli_error($con));;
   $msg="Message Sent SucccessFully";
   header("location:msg.php?msg='".$sellerid."'");
}
   

?>
   <title>Welcome to Home Feed</title>
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
   <body >
      <?php include 'includes/header.php';
      //$user_name=$_SESSION['user_name'];
     //$sellerid=$_SESSION['sellerid'];
   ?>


  	<div class="container margin-container">

  		 
								    		<?php

								    			$query_notif = "SELECT * FROM pvt_msgs WHERE _to = '".$buyerid."' ";
										if($run_query_notif = mysqli_query($con,$query_notif))
											{

												$no_of_unread_messages = mysqli_num_rows($run_query_notif);


										    }

										    $query_notif_badge = "SELECT * FROM pvt_msgs WHERE _to = '".$buyerid."' AND  _read = 'no' ";
										if($run_query_notif_badge = mysqli_query($con,$query_notif_badge))
											{

												$no_of_unread_messages_badge = mysqli_num_rows($run_query_notif_badge);


										    }
										    
										?>
								    		<div class="panel panel-primary" style="margin-bottom:250px;" >
		                              <div class="panel-heading panel_heading_height">
                                             <span class="glyphicon glyphicon-comment font-icon" aria-hidden="true"> Inbox</span>&nbsp;&nbsp;&nbsp;
    
                                                   </div>
								    		 <div class="panel-body">
										
								            <div class="modal-dialog">

								             
								              <div class="modal-content">
								                <div class="modal-header">
								                  
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
															 <button class="btn btn-info dropdown-toggle" id ="message_drop" name = "dropdown_button" method="POST" type="button" data-toggle="dropdown">Your Message:
															  </button>

															 	<ul class="dropdown-toggle">
															    <li><?php echo $row_messages['message'];
															    	
															    //$msgid = $row_messages['msgid'];
															    $msgid = $row_messages['msgid'];
															    $update_query = "UPDATE pvt_msgs SET _read= 'yes' WHERE msgid = '".$msgid."' ";
															    $run_query_update = mysqli_query($con,$update_query);

															     ?></li>
																<button class="btn btn-success"><a href="buyer_profile.php">Mark as read!</a></button>
																
																
																
															
															<a href ="delete_msg.php?id=<?php echo $msgid; ?>"><button type="submit" class="btn btn-danger btn-lg" value="submit" name="delete"><span class='glyphicon glyphicon-trash'></span></button></a>
         
															 
															 
															 
															 
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
      <?php 
	   include("includes/footer.php");
 
      ?>
  	</body>
  	</html>
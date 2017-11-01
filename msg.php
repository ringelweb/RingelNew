<?php

require 'includes/connect.php';
$user_name=$_SESSION['user_name'];
$sellerid=$_SESSION['sellerid'];
$msg="";


														 
															
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
   //header("location:msg.php");
   
	
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
      $user_name=$_SESSION['user_name'];
     $sellerid=$_SESSION['sellerid'];
   ?>


  	<div class="container margin-container">
  <?php if(isset($msg) && $msg!=""){ 
            ?>
         <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <center> <strong>Alert: </strong><?php echo $msg?></center>
         </div>
         <?php }?>
  		 
								    		<?php

								    			$query_notif = "SELECT * FROM pvt_msgs WHERE _to = '".$sellerid."' ";
										if($run_query_notif = mysqli_query($con,$query_notif))
											{

												$no_of_unread_messages = mysqli_num_rows($run_query_notif);


										    }

										    $query_notif_badge = "SELECT * FROM pvt_msgs WHERE _to = '".$sellerid."' AND  _read = 'no' ";
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
																<button class="btn btn-success"><a href="seller_profile.php">Mark as read!</a></button>
																
																<?php $q1="select * from pvt_msgs where msgid='".$msgid."'";
																$r1 = mysqli_query($con,$q1);
																$row1 = mysqli_fetch_array($r1);
																$_from=$row1["_from"];
																$q2="select * from buyer_users where username='".$_from."'";
																$r2 = mysqli_query($con,$q2);
																	$row2 = mysqli_fetch_array($r2);
																$buyerid=$row2["buyerid"];
																  $_SESSION['msg_to']=$buyerid;     
																?>
																
															
															<button data-toggle="modal" data-target="#send_message<?php echo $buyerid?>" class="btn btn-primary btn-m"style="margin-bottom:5px;">Reply</button> 
															<a href ="delete_msg.php?id=<?php echo $msgid; ?>"><button type="submit" class="btn btn-danger btn-lg" value="submit" name="delete"><span class='glyphicon glyphicon-trash'></span></button></a>
              <div id="send_message<?php echo $buyerid ;?>" class="modal fade" role="dialog">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Send Message To:<span style="color:green"><?php echo $_from;?></span></h4>
                           </div>
                           <div class="modal-body">
                              <!--  form starts here-->
                              <form id = "message_form" action="" method="POST" enctype="multipart/form-data">
                                 <div class="form-group">
                                    <input value="<?php echo $buyerid;?>" type="hidden" name="seller_id">
                                 </div>
                                 <div class="form-group">
                                    <textarea class="form-control"  placeholder=" <?php echo $buyerid; ?>" name="comment_body" placeholder="Type your message here"></textarea>
                                 </div>
                                 <input type="submit" class="btn btn-block btn-success" value="submit" name="message_submit" >
                                 <!--  form ends here-->
                              </form>
                              <!-- logic to insert comment-->
                           </div>
                        </div>
                     </div>
                  </div>
															 
															 
															 
															 
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
      $user_name=$_SESSION['user_name'];
    $sellerid=$_SESSION['sellerid'];
      ?>
  	</body>
  	</html>
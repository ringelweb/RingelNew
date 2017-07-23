<?php
   require 'includes/connect.php';
   $buyer_user_name=$_SESSION['buyer_user_name'];
   $buyerid=$_SESSION['buyerid'];
   
   
    //Declaring variables to prevent error
   if(!isset($_SESSION['buyer_user_name']))
   {
       header('Location: index.php?msg=Please Log in First');
   }
   $query="SELECT buyername,profilepic FROM buyer_info WHERE buyerid='".$buyerid."'";
   $result= mysqli_query($con, $query);
    $row= mysqli_fetch_array($result);
    //logic to display the posts from product_info table 
    //only recent 6 are shown
   
   
   ?>
<!DOCTYPE html>
<html>
   <title>Welcome to Home Feed</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <link href="css/style.css" rel="stylesheet">
   <script src="js/jquery.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <body >
      <?php
         include 'includes/header.php';
         $buyer_user_name=$_SESSION['buyer_user_name'];
         $buyerid=$_SESSION['buyerid'];
         ?>
      <div class="container margin-container">
         <?php 
            if(isset($_POST['message_submit']))
            			        	{
            			        		$message_to = $_POST['seller_name'];
            			        		$message_body = $_POST['comment_body'];
            
            			        		
            			        		$query = "SELECT * from users WHERE username = '".$message_to."' ";
            			        		$run_query = mysqli_query($con,$query);
            
            			        		if(mysqli_num_rows($run_query) == 0)
            			        			{
            			        				?>
         <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Warning:</strong> Please check and Enter again. Seller not found in our database!
         </div>
         <?php
            }
            else
            {	
            
            
            
            $query = "INSERT INTO pvt_msgs(_to, _from, message, _read) VALUES ('".$message_to."','".$buyer_user_name."','".$message_body."', 'no')";
            $insert_message = mysqli_query($con,$query);
            
            
            ?>
         <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success:</strong> Message sent successfully!
         </div>
         <?php
            }
            }
            
            ?>
         <div class="row">
            <div class="col-md-12 ">
               <div class="panel panel-primary panel_setting" >
                  <div class="panel-heading panel_heading_height">
                     <span class="glyphicon glyphicon-user font-icon" aria-hidden="true"> Profile</span>&nbsp;&nbsp;&nbsp;
    
                  </div>
                  <div class="panel-body">
                     <div class="col-sm-offset-6 col-md-2 row-control">
                        <button class="btn btn-success btn-block">
                        <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                        Order Status</button>
                     </div>
                     <div class="col-md-2 row-control">
                        <button class="btn btn-success btn-block" data-toggle="modal" data-target="#send_message">
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                        Message</button>
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
                                          <input style="width:300px" class="form-control" type="text" name="seller_name" placeholder="Enter Seller name to send Message to..." required >
                                       </div>
                                       <div class="form-group">
                                          <textarea class="form-control" name="comment_body" placeholder="your message goes here..." required></textarea>
                                       </div>
                                       <input type="submit" class="btn btn-block btn-success" value="submit" name="message_submit" >
                                       <!--  form ends here-->
                                    </form>
                                    <!-- logic to insert comment-->
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--inbox for buyer goes here-->
                     <div class="col-md-2 row-control">
                        <button class="btn btn-success btn-block" data-toggle="modal" data-target="#check_inbox" >
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        View Inbox
                        <?php
                           $query_notif = "SELECT * FROM pvt_msgs WHERE _to = '".$buyer_user_name."'  ";
                           if($run_query_notif = mysqli_query($con,$query_notif))
                           {
                           
                           $no_of_unread_messages = mysqli_num_rows($run_query_notif);
                           
                           
                           }
                           
                           $query_notif_badge = "SELECT * FROM pvt_msgs WHERE _to = '".$buyer_user_name."' AND _read = 'no' ";
                           if($run_query_notif_badge = mysqli_query($con,$query_notif_badge))
                           {
                           
                           $no_of_unread_messages_bagde = mysqli_num_rows($run_query_notif_badge);
                           
                           
                           }
                           
                           
                           
                           if($no_of_unread_messages_bagde > 0)
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
                                         
                                             <ul style="text-decoration:none"> 
                                                <li style="text-decoration:none">
								
												<?php echo $row_messages['message'];
										echo "&nbsp&nbsp&nbsp<a style='text-decoration:none'  href='buyer_profile.php'>Mark As Read</a>";
                                                   //$msgid = $row_messages['msgid'];
                                                   $msgid = $row_messages['msgid'];
                                                   $update_query = "UPDATE pvt_msgs SET _read= 'yes' WHERE msgid = '".$msgid."' ";
                                                   $run_query_update = mysqli_query($con,$update_query);
                                                   
                                                  ?>
    
												<a onclick="confirm('are you sure?')" style="text-decoration:none"  class="float-right"  href="buyer_profile.php"><span style="float: right;" class="glyphicon glyphicon-trash"> </span></a>
												  </li>
                                              
                                             </ul>
                                         
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
                     <!--End of inbox-->
                  </div>
               </div>
            </div>
         </div>
         <br>
		 <div class="">
		 
		 
		 
		 
		 <div class="col-md-4">
			<div class="row">
              
            <center>               <a href="#" >
                          <img class="img-circle" src="<?php echo "img/buyer_img/".$row['profilepic'].""; ?>" height="200px" width="200px">
	<!-- for testing			<center>	<img src="img/icons/product.png"></center> -->	
                           </a></center>
             </div>
			 <br>
			 <div class="row">
				
  	<center>	<button style="width:80%" class="btn btn-danger btn-block">
			<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
								    		Account Setting</button><center>
  				
  			
			</div>
                     
            </div>
			<br>
        <div class="col-md-8 ">
            <div class="row ">
               <div class="panel panel-info panel_setting" >
                  <div class="panel-body div-hover">
                     <div class="col-md-3 row-control">
                        <button class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                        Likes
                        </button>
                     </div>
                     <div class=" col-md-offset-1 col-md-3 row-control">
                        <button class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-align-right" aria-hidden="true"></span>
                        Following</button>
                     </div>
                     <div class=" col-md-offset-1 col-md-3 row-control">
                        <button class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>
                        Followers</button>
                     </div>
                  </div>
				   
               </div>
			   
            </div>
			<!--
			 <div class="row">
               <div class="well well-lg" >
			   
                  <button class="btn btn-warning btn-block">
                  <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>
                  Order a Product</button>
               </div>
              </div>
			  -->
			  
           <div class="row">
         <div class="panel panel-danger panel_setting ">
         <div class="panel-heading">Shared Post</div>
         <div class="panel-body div-hover" >
                  <div class="panel-body">
                  <div class="row">
                     <div class="col-xs-6 col-md-4">
                        <a href="#" class="thumbnail">
                        <img src="img/product_img/coder.jpg" height="100px">
                        </a>
                     </div>
                     <div class="col-xs-6 col-md-4">
                        <a href="#" class="thumbnail">
                        <img src="img/product_img/coder.jpg" height="100px">
                        </a>
                     </div>
                     <div class="col-xs-6 col-md-4">
                        <a href="#" class="thumbnail">
                        <img src="img/product_img/coder.jpg" height="100px">
                        </a>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xs-6 col-md-4">
                        <a href="#" class="thumbnail">
                        <img src="img/product_img/coder.jpg" height="100px">
                        </a>
                     </div>
                     <div class="col-xs-6 col-md-4">
                        <a href="#" class="thumbnail">
                        <img src="img/product_img/coder.jpg" height="100px">
                        </a>
                     </div>
                     <div class="col-xs-6 col-md-4">
                        <a href="#" class="thumbnail">
                        <img src="img/product_img/coder.jpg" height="100px">
                        </a>
                     </div>
                  </div>
               </div>
            </div>
		</div>
		</div>
		
		
        
 </div>
 
 
     
		</div>	
			
			
			
			
			
			
			
			</div>
 
   
      
	  <br>
      <?php include'includes/footer.php';
         $buyer_user_name=$_SESSION['buyer_user_name'];
         $buyerid=$_SESSION['buyerid'];?>
   </body>
</html>
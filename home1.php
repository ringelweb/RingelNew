<?php 
   require 'includes/connect.php';
   
   
   /*
   if (isset($_SESSION['buyer_user_name'])||isset($_SESSION['user_name'])){
   if (isset($_SESSION['buyer_user_name'])) {
        $buyer_user_name=$_SESSION['buyer_user_name'];
   $result=mysqli_query($con,"SELECT buyerid FROM buyer_users WHERE username='".$buyer_user_name."'"); 
   $row=mysqli_fetch_array($result);
   $buyerid=$row['buyerid'];
   $result5=mysqli_query($con,"SELECT * FROM buyer_info WHERE buyerid='".$buyerid."'");
   $row2= mysqli_fetch_array($result5);
   
   }
    */
   
        
   ?>
<!-- Logic Script for Likes -->		
<?php
   if(isset($_POST['like_submit']) && isset($_SESSION['buyer_user_name']) ){      
                  $buyer= $_POST['buyer_id']; 
   				  $seller = $_POST['seller_id']; 
   				   $Product= $_POST['product_id'];
   				 $like_result =mysqli_query($con,"INSERT INTO product_likes(product_id, buyer_id,seller_id) VALUES ('".$Product."','".$buyer."','".$seller."')");
   if($like_result>0){
    $msg="you Liked";
   
   }else{
    $msg="You have already Liked this product";
   }
   }
   
   ?>
<?php
   //logic to insert comments into database using comment modal
    if(isset($_POST['comment_submit']) && isset($_SESSION['buyer_user_name']) )
    { 
          $review_body = $_POST['review_body']; 
   $reviewBy = $_POST['buyer_id']; 
   $reviewPostBy = $_POST['seller_id']; 
   $reviewOn = $_POST['product_id']; 
          $insert_comment =mysqli_query($con,"INSERT INTO productreview(productid, sellerid, buyerid, review) VALUES ('".$reviewOn."','".$reviewPostBy."','".$reviewBy."','".$review_body."')");
        if ( $insert_comment>0){ 
   $msg="Thanks to give Review on our product!!";//set flag so that comment is not inserted multiple times   
               
   } 
   else{
   $msg="Error description: " . mysqli_error($con);
   }
   }
    //end of logic to insert comment 
   ?>			 
<!--Message Script starts -->
<?php 
   if(isset($_POST['message_submit']))
   			        	{
   			        		$message_to = $_POST['seller_id'];
   			        		$message_body = $_POST['comment_body'];
                          if (isset($_SESSION['buyer_user_name'])) {
                            $buyer_user_name=$_SESSION['buyer_user_name'];
   			  }
   			        		$query = "SELECT * from users WHERE id = '".$message_to."' ";
   			        		$run_query = mysqli_query($con,$query);
   
   			        		if(mysqli_num_rows($run_query) == 0)
   			        			{
                   $msg="Please check and Enter again. Seller not found in our database!";
                   }
                 else
                     {	
   
   $query = "INSERT INTO pvt_msgs(_to, _from, message, _read) VALUES ('".$message_to."','".$buyer_user_name."','".$message_body."', 'no')";
   $insert_message = mysqli_query($con,$query);
   $msg="Message Sent SucccessFully";
   }
   }
   
   ?>
<!-- Message System ends -->
<!DOCTYPE html>
<html>
<head>
   <title>Welcome to Home Feed</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <link href="css/style.css" rel="stylesheet">
   <script src="js/jquery.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
   <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="css/modal.css" rel="stylesheet" type="text/css"  media="all" />
   <style>
   .affix {
    top:50px;
    position:fixed;
	z-index: 99 !important;
}
   </style>
   </head>
   <body class="w3-theme-l5">
      <?php include 'includes/header.php'; ?>
      <div class="w3-container w3-content container" style="max-width:1400px;margin-top:70px">
         <!-- Alert Panel-->
         <?php if(isset($msg) && $msg!=""){ 
            ?>
         <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <center> <strong>Alert: </strong><?php echo $msg?></center>
         </div>
         <?php }?>
         <!-- The Grid -->
         <div class="w3-row" >
            <!-- Left Column for seller STARTS -->
            <div class="w3-col m3 " style="margin-right: 10px;">
               <?php if(isset($_SESSION['user_name'])) { 
                  $user_name=$_SESSION['user_name'];
                  $idresult=mysqli_query($con,"SELECT id FROM users WHERE username='".$user_name."'"); 
                  $idrow=mysqli_fetch_array($idresult);
                   $sellerid=$idrow['id'];
                    $query="SELECT orgname,address,coverimage,siteurl,contact,email FROM org_info WHERE sellerid='".$sellerid."'";
                    $org_info_result= mysqli_query($con, $query);
                     $org_info_row= mysqli_fetch_array( $org_info_result);       
                            
                            ?>
               <div class="w3-card-2 w3-round w3-white" style="padding-left: 5px;padding-right: 5px;">
                  <div class="w3-container">
                     <h3 style="font-weight:600;color:green" class="w3-center">Seller's Profile</h3>
                     <p class="w3-center"> <img src="<?php echo "img/org_coverimg/".$org_info_row['coverimage'].""; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                     <hr>
                     <p><i class="fa fa-user w3-margin-right w3-text-theme "></i> <span class="link w3-text-theme"><?php echo  strtoupper($org_info_row['orgname']);?></span></p>
                     <p><i class="fa fa-link w3-margin-right w3-text-theme "> <span class="link w3-text-theme">        <?php echo $org_info_row['siteurl']; ?></span></i></p>
					 <p><i class="fa fa-address-card fa-fw w3-margin-right w3-text-theme"></i><span class="w3-text-theme"><?php echo $org_info_row['address']; ?></span></p>
                  </div>
				   <?php if(isset($_SESSION['user_name'])) { ?>
               <div class="container-fluid" data-spy="affix" data-offset-top="200" class="w3-row-padding " style="width:100%;left: 0px;padding-left: 0px;padding-right: 0px;">
                  
                           <center> 
                              <button onclick="location.href = 'postproduct.php'" id="myButton" class="btn btn-success btn-block" >Post New Product</button>
                           </center>
                    
               </div>
               <?php } ?>
			   <br>
               </div>
               <?php } ?>
               <!-- Left Column for seller ENDS -->
               <br>
               <!-- Left Column for BUYER STARTS -->
               <?php if(isset($_SESSION['buyer_user_name'])) {
                  $buyer_user_name=$_SESSION['buyer_user_name'];
                  $result=mysqli_query($con,"SELECT buyerid FROM buyer_users WHERE username='".$buyer_user_name."'"); 
                  $row=mysqli_fetch_array($result);
                  $buyerid=$row['buyerid'];
                  
                  $buyer_result=mysqli_query($con,"SELECT * FROM buyer_info WHERE buyerid='".$buyerid."'");
                  $buyer_row= mysqli_fetch_array($buyer_result);
                  
                     ?>
               <div class="w3-card-2 w3-round w3-white" style="padding-left: 5px; padding-right: 5px;">
                  <div class="w3-container">
                     <h3 style="font-weight:600;color:green" class="w3-center">Buyer's Profile</h3>
                     <p class="w3-center"> <img src="<?php echo "img/buyer_img/".$buyer_row['profilepic'].""; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                     <hr>
					 
                     <p><i class="fa fa-user w3-margin-right w3-text-theme "></i> <span class="link w3-text-theme"><?php echo  strtoupper($buyer_row['buyername']);?></span></p>
                     <p><i class="fa fa-envelope w3-margin-right w3-text-theme "></i> <span class="link w3-text-theme"><?php echo $buyer_row['email']; ?></span></p>
                     <p><i class="fa fa-address-card fa-fw w3-margin-right w3-text-theme"></i><span class="w3-text-theme"><?php echo $buyer_row['address']; ?></span></p>
                  </div>
               </div>
               <?php }  ?>
               <!-- End Left Column for buyer -->
            </div>
            <!-- .................................................................................................................................-->	
            <!-- TOP SHOW IF SELLER -->
            <div class="w3-col m7">
              
               <!-- END TOP SHOW IF SELLER -->
               <?php
                  /*
                                 if(isset($_SESSION['user_name'])){
                                  $user_name=$_SESSION['user_name'];
                                 }     
                               */  
                                       $query="SELECT * FROM product_info";
                                       $result= mysqli_query($con, $query);
                  			$i= mysqli_num_rows($result);
                  		//	echo "<script>alert('hello'.'mysqli_num_rows($result)')</script>";
                  		   $flag = 0;
                  		  while ($i>0) {
                  			  
                  			 $row=mysqli_fetch_array($result);
                                        $sellerId=$row['sellerid'];
                  			 $productid=$row['productid'];
                  			  
                  			 $result_org= mysqli_query($con,"SELECT coverimage,orgname FROM org_info WHERE sellerid='".$sellerId."'");
                                        $row_org= mysqli_fetch_array($result_org);
                  			 
                  			 $coverimage= $row_org['coverimage'];
                  			 $orgname= $row_org['orgname'];
                  			 //getting time start
                                        $timestamp = strtotime($row['time']);
                                        $date = date('d-m-Y', $timestamp);
                                        $time = date('H:i:s',strtotime($timestamp));
                  			 //getting time end
                                        $productname=$row['productname'];
                  			 $productimage=$row['productimage'];
                  			 $category=$row['category'];
                  			 $quantity=$row['quantity'];
                  			 $description=$row['description'];
                  	         $likeFlag="flag".$productid;
                  			 $likeFlag=0;
                                  ?>
               <div class="w3-container w3-card-2 w3-white w3-round" style="
    margin-bottom: 10px">
                  <br>
                  <a href="seller_profile.php?id=<?php echo $sellerId;?>"><img src="<?php echo "img/org_coverimg/".$coverimage.""; ?>" alt="Store Image" class="w3-left w3-margin-right w3-block" style="width:60px">
                  </a><span class="w3-right badge" style="color:#3c763d;background:rgba(19, 17, 17, 0.13);"><?php echo"<i class='glyphicon glyphicon-time'></i> " .$time."<br>".$date;?></span>
                  <div class="row">
                     <div class="col-sm-2">
                        <a href="seller_profile.php?id=<?php echo $sellerId;?>">
                           <h4 style="font-weight:600;color:green;"><?php echo"".$orgname.""?></h4>
                        </a>
                     </div>
                  </div>
                  <hr>
                  <!-- """"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""-->
                  <img src="<?php echo "img/product_img/".$productimage.""; ?>" class="w3-margin-bottom img-responsive">
                  <span class="label label-danger "> <?php echo"".$category.""?></span> 
                  <br>
                  <label for="category" class="badge-warning"></label>
                  <label for="name" class="product-name"><?php echo"".$productname.""?></label><br>
                  <div class="row" style="padding-bottom:10px">
                     <div class="col-sm-3" ><label for="description" class="badge product-description">Description:  </label></div>
                     <div class="col-sm-9 div-hover"><?php echo"".$description.""?></div>
                  </div>
				  <?php
				  
				          //getting likes count
						   $ress=mysqli_query($con,"SELECT COUNT('product_id') as count FROM product_likes where product_id=$productid");
                           $countRow= mysqli_fetch_array($ress);
						   $LikesCount=$countRow['count'];
						   //getting reviews count
                           $reviewResult=mysqli_query($con,"SELECT COUNT('productid' ) as count FROM productreview where productid=$productid");
                           $countReview= mysqli_fetch_array($reviewResult);
						   $ReviewCount=$countReview['count'];		
				  
				  
				  
				  
				  ?>
				  
				  
				  
				  
                  <!--LIKE BUTTON FOR BUYER -->
				  
                  <div class="row">
				  <div class="">
                     <?php if(isset($_SESSION['buyer_user_name'])){?>
                     <div class="col-sm-2">
                        <form action="home1.php" method="POST">
                           <input type="hidden" name="product_id" value="<?php echo $productid;?>">
                           <input type="hidden" name="buyer_id" value="<?php echo $buyerid;?>">
                           <input type="hidden" name="seller_id" value="<?php echo $sellerId;?>">
                           <button type="submit" class="btn btn-primary btn-xs btn-block "style="margin-bottom:5px;" value="submit" name="like_submit" ><i><?php echo $LikesCount;?></i> Likes</button>
                        </form>
                     </div>
                     <!--LIKE BUTTON FOR SELLER -->
                     <?php }else{?>
					 
                   
					 <div class="col-sm-2">
                     <button onclick="return alert('Sorry You Can not Like')" class="btn btn-primary btn-xs btn-block "style="margin-bottom:5px;" name="like"><?php echo $LikesCount;?></i>  Likes</button>
					 </div>
                    
					 
                     <?php }?>
                     <div class="col-sm-2">
                        <!--SHOW REVIEW BUTTON -->
                        <button class="btn btn-primary btn-xs btn-block "style="margin-bottom:5px;" data-toggle="modal" data-target="#<?php echo $productid?>"><i><?php echo $ReviewCount;?></i> Reviews</button> 
                     </div>
                     <div class="col-sm-2 ">
                        <button class="btn btn-primary btn-xs btn-block" style="margin-bottom:5px;">Share</button> 
                     </div>
                     <?php if(isset($_SESSION['buyer_user_name'])){ ?>
                     <div class="col-sm-3" >
                        <button type="button" class="btn btn-primary btn-xs btn-block "style="margin-bottom:5px;">Buy(<?php echo"".$quantity.""?>)left!</button> 
                     </div>
                     <div class="col-sm-2">
                        <button data-toggle="modal" data-target="#send_message<?php echo $sellerId?>" class="btn btn-primary btn-xs btn-block"style="margin-bottom:5px;">Message</button> 
                     </div>
                     <?php } ?>
                  </div>
				  </div>
                  <!--MESSAGE MODAL -->
                  <div id="send_message<?php echo $sellerId ;?>" class="modal fade" role="dialog">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Send Message To:<span style="color:green"><?php echo $orgname;?></span></h4>
                           </div>
                           <div class="modal-body">
                              <!--  form starts here-->
                              <form id = "message_form" action="" method="POST" enctype="multipart/form-data">
                                 <div class="form-group">
                                    <input value="<?php echo $sellerId;?>" type="hidden" name="seller_id">
                                 </div>
                                 <div class="form-group">
                                    <textarea class="form-control" name="comment_body" placeholder="Type your message here"></textarea>
                                 </div>
                                 <input type="submit" class="btn btn-block btn-success" value="submit" name="message_submit" >
                                 <!--  form ends here-->
                              </form>
                              <!-- logic to insert comment-->
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--Comment view modal -->
                  <div id="<?php echo $productid;?>" class="modal fade" role="dialog">
                     <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Reviews For: <span style="color:red"><?php echo $productname;?></span></h4>
                           </div>
                           <div class="modal-body">
                              <?php 
                                 $res=mysqli_query($con,"SELECT *FROM productreview where productid=$productid"); 
                                    if(mysqli_num_rows($res)==0) echo "Sorry!! No Reviews Yet";
                                 $k=mysqli_num_rows($res);
                                 while($k>0)
                                 {	
                                   $r=mysqli_fetch_array($res);
                                 $b=$r['buyerid'];
                                 $name=mysqli_query($con,"SELECT * from buyer_info where buyerid=$b"); 
                                 $x=mysqli_fetch_array($name);
                                 echo"<li>".$r['review']."<a href='buyer_profile.php?id=$b'>"."<span style='float:right;color:green'>"."By:".$x['buyername']."</a>"."</span>"."</li>";
                                 $k--;} ?>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- comments BUTTON  -->
                  <?php if(isset($_SESSION['buyer_user_name'])){
                     ?><br>
                  <button style="margin-bottom:5px" class="btn btn-xs btn-success" data-toggle="collapse" data-target="#<?php echo $productid."send"?>">Post Your Review</button>
                  <div id="<?php echo $productid."send"?>" class="collapse">
                     <form id = "comment_form" action="home1.php" method="POST" enctype="multipart/form-data">
                        <div style="margin-bottom:5px">
                           <textarea class="form-control" name="review_body" placeholder="your comment goes here..."></textarea>
                        </div>
                        <input type="hidden" value="<?php echo $productid;?>" name="product_id">
                        <input type="hidden" value="<?php echo $buyerid;?>" name="buyer_id">
                        <input type="hidden" value="<?php echo $sellerId;?>" name="seller_id">
                        <input  style="float:right;margin-bottom:5px !important;" type="submit" class="btn btn-primary btn-sm " value="Send" name="comment_submit">
                        <!--  form ends here-->
                     </form>
                  </div>
                  <?php } ?>     
                  <br>
               </div>
               <?php $i--; } ?>
               <!-- End Middle Column -->
            </div>
            <!-- End Grid -->
         </div>
         <!-- End Page Container -->
      </div>
      <br>
      <?php include("includes/footer.php"); ?>
   </body>
</html>
<?php 
require 'includes/connect.php';

if (isset($_SESSION['buyer_user_name'])||isset($_SESSION['user_name'])){
if (isset($_SESSION['buyer_user_name'])) {
     $buyer_user_name=$_SESSION['buyer_user_name'];
$result=mysqli_query($con,"SELECT buyerid FROM buyer_users WHERE username='".$buyer_user_name."'"); 
$row=mysqli_fetch_array($result);
$buyerid=$row['buyerid'];
$result5=mysqli_query($con,"SELECT * FROM buyer_info WHERE buyerid='".$buyerid."'");
$row2= mysqli_fetch_array($result5);

}
if(!empty($_GET)){ 
      $prodid=$_GET['prodid'];
      $seller_result= mysqli_query($con,"SELECT sellerid FROM product_info WHERE productid='".$prodid."'");
      
      $seller_row= mysqli_fetch_array($seller_result);
      $sell_id=$seller_row['sellerid'];
      $query="INSERT INTO product_likes VALUES('','".$prodid."','".$sell_id."','".$buyerid."')";
      $like_result=mysqli_query($con,$query);
}
      
      
      
  

if (isset($_SESSION['user_name'])) {
     $user_name=$_SESSION['user_name'];
$result=mysqli_query($con,"SELECT id FROM users WHERE username='".$user_name."'"); 
$row=mysqli_fetch_array($result);
$sellerid=$row['id'];}

//logic to insert comments into database using comment modal
  if(isset($_POST['comment_submit']))
  {

  }

//end of logic to insert comment
  
  
  
  
  
  
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
		
<body class="w3-theme-l5">
    <?php include 'includes/header.php'; ?>
    
<div class="w3-container w3-content container" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->

<?php if(isset($_SESSION['user_name'])) { 
$query="SELECT orgname,address,coverimage,siteurl,contact,email FROM org_info WHERE sellerid='".$sellerid."'";
$result= mysqli_query($con, $query);
 $row= mysqli_fetch_array($result);       
        
        ?>
<!-- Page Container -->

      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
          
         <h4 class="w3-center"><?php echo $row['orgname']; ?></h4>
         <p class="w3-center"> <img src="<?php echo "img/org_coverimg/".$row['coverimage'].""; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-link fa-fw w3-margin-right w3-text-theme"></i> <?php echo $row['siteurl']; ?></p>
         <p><i class="fa fa-address-card fa-fw w3-margin-right w3-text-theme"></i> <?php echo $row['address']; ?></p>
        </div>
      </div>
<?php } ?>
      <br>
    <?php if(isset($_SESSION['buyer_user_name'])) { ?>
      <div class="w3-card-2 w3-round w3-white">
     
        <div class="w3-container">
         <h4 class="w3-center"><?php echo $buyer_user_name;?></h4>
         <p class="w3-center"> <img src="<?php echo "img/buyer_img/".$row2['profilepic'].""; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-user-circle fa-fw w3-margin-right w3-text-theme"></i> <?php echo $buyer_user_name;?></p>
 <p><i class="fa fa-link fa-fw w3-margin-right w3-text-theme"></i> <?php echo $row['siteurl']; ?></p>
         <p><i class="fa fa-address-card fa-fw w3-margin-right w3-text-theme"></i> <?php echo $row['address']; ?></p>
        </div>
      </div>
     <?php }  ?>
      
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
     <?php if(isset($_SESSION['user_name'])) { ?>
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card-2 w3-round w3-white">
            <div class="w3-container w3-padding">
             <h6 class="w3-opacity">POST NEW PRODUCT</h6>
            <center>   <button onclick="location.href = 'postproduct.php'" id="myButton" class="float-left submit-button" >Post Product</button></center>
            </div>
          </div>
        </div>
      </div>
     <?php } ?>
      
   <?php
         
         $user_name=$_SESSION['user_name'];
         $query="SELECT * FROM product_info";
         $result= mysqli_query($con, $query);
         $flag = 0;
         while ($row = mysqli_fetch_array($result)) {
            $sellerinfo=$row['sellerid'];
            $productname=$row['productname'];
            
             $result1= mysqli_query($con,"SELECT coverimage,orgname FROM org_info WHERE sellerid='".$sellerinfo."'");
             $row1= mysqli_fetch_array($result1); 

             $get_productid_query = mysqli_query($con,"SELECT productid FROM product_info WHERE sellerid = $sellerinfo AND productname = '".$productname."' ");
             $result_productinfo_query = mysqli_fetch_array($get_productid_query);
             $productid = $result_productinfo_query['productid'];
            // echo $productid;                   
    ?>
     
        

      <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
        <img src="<?php echo "img/org_coverimg/".$row1['coverimage'].""; ?>" alt="Store Image" class="w3-left w3-margin-right w3-block" style="width:60px">
        <span class="w3-right w3-opacity"><?php

echo "Posted on " . date("h:i:sa");
?></span>
        
        <h4><a href="seller_profile.php?id=<?php echo $row['sellerid'];?>"><?php echo"".$row1["orgname"].""?></a></h4>
        <hr class="w3-clear">
        <img src="<?php echo "img/product_img/".$row['productimage'].""; ?>" class="w3-margin-bottom img-responsive">
		<span class="label label-danger "> <?php echo"".$row["category"].""?></span> 
		<span class="label label-warning">category</span>
		<span class="label label-primary">category</span><br>
		<label for="category" class="badge-warning"></label>
	   <label for="name" class="product-name"><?php echo"".$row["productname"].""?></label><br>
      <div class="row" style="padding-bottom:10px">
	  <div class="col-sm-3" ><label for="description" class="badge"product-description">Description:  </label></div>
	  <div class="col-sm-9"><?php echo"".$row["description"].""?></div>            
        </div>
		<div class="row">
		
		</div>
     
            <a href="home1.php?prodid=<?php echo $row['productid'];?>">
			<button type="submit" class="w3-button w3-theme-d1 w3-margin-bottom " 
			name="like"><i class="fa fa-heart"></i>  Like</button></a>
     
        <!--logic for review starts here  -->
        <button type="button"  class="w3-button w3-theme-d2 w3-margin-bottom button-edge-round" data-toggle="modal" data-target="#myModal" ><i class="fa fa-comment"></i>  Review</button> 

        <!-- Clicking review button above launches comment modal -->
            <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

             
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add your comments here...</h4>
                </div>
                <div class="modal-body">
                <!--  form starts here-->
                <form id = "comment_form" action="home1.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <textarea class="form-control" name="comment_body" placeholder="your comment goes here..."></textarea>
                  </div>
                  <input type="submit" class="btn btn-block btn-success " value="submit" name="comment_submit">
                  <!--  form ends here-->
                </form>
                <!-- logic to insert comment-->
                 <?php

                   //logic to insert comments into database using comment modal
                    if(isset($_POST['comment_submit']) && $flag == 0)
                    {
                        
                        $review_body = $_POST['comment_body'];
  
                          
                          $insert_comment =mysqli_query($con,"INSERT INTO productreview(productid, sellerid, buyerid, review) VALUES ('".$productid."','".$sellerinfo."','".$buyerid."','".$review_body."')");
                          $flag = 1;//set flag so that comment is not inserted multiple times


                        
                    } 

                    //end of logic to insert comment 
                  ?>

                <!--end of logic to insert comment-->

                </div>
                
              </div>

            </div>
          </div>

        <!--End of comment modal -->
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom button-edge-round"><i class="	fa fa-shopping-cart "></i>  Buy (<?php echo"".$row["quantity"].""?>) left!</button> 
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom button-edge-round"><i class="fa fa-share"></i>  Share</button> 

          
        <div class="comment_section">
          <!--  -->
          <label>Comments</label>
          <div class="panel panel-info panel_setting" >
          <div class="panel-body">

                  
                      
                
               <!-- logic to display comment goes here--> 
          testing ....



          </div>
          </div>

          <!-- -->
        </div>
      </div> 
         <?php } ?>
      
    <!-- End Middle Column -->
    </div>
    
   
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>


<?php include("includes/footer.php"); ?>
 
<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html> 
<?php } 

if (isset($sellerid)&& isset($user_name)){
$_SESSION['sellerid']=$sellerid;
$_SESSION['user_name']=$user_name;
}

if (isset($buyerid)&& isset($buyer_user_name)){
$_SESSION['buyerid']=$buyerid;
$_SESSION['buyer_user_name']=$buyer_user_name;
}?>
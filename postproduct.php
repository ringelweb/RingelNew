<?php
require("includes/connect.php");
if (isset($_SESSION['user_name'])) {
     $user_name=$_SESSION['user_name'];
$result=mysqli_query($con,"SELECT id FROM users WHERE username='".$user_name."'"); 
$row=mysqli_fetch_array($result);
$sellerid=$row['id'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Product Post</title>
         <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <div class="container-fluid decor_bg margin-container" id="content">
            <div class="row">
                <div class="container">
                    <div class="col-sm-6 col-sm-offset-3 div-hover div-pad" >
					<center><img src="img/icons/product.png" width="80px"></center>
                        <h2 class="text-center">POST PRODUCT</h2>
                        <form  action="postproduct_script.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                
                             <input class="form-control" type="hidden" name="size" value="1000000">
                            </div>
                            <div class="form-group">
                                Select image to upload:<input type="file" name="image" class='form-control'>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="description" cols='40' rows='5' placeholder="Product Description"></textarea>
                            </div>
                            <div class="form-group">
                                <input  type="text" class="form-control"  placeholder="Product Name" name="product_name" required = "true">
                            </div>
                            <div class="form-group">
                                <input  type="text" class="form-control"  placeholder="Category" name="category" required = "true">
                            </div>
                            <div class="form-group">
                                <input  type="text" class="form-control"  placeholder="Quantity" name="quantity" required = "true">
                            </div>
                            <a href="home1.php"><input type="submit" name="upload" value="Post Now" class="btn btn-primary" style="width:100%"></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		<br><br><br>
        <?php include "includes/footer.php"; ?>
        
    </body>
</html>

<?php  }
header("Location:home1.php");?>

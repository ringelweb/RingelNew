

<?php
require("includes/connect.php");

        



//ob_start();

$user_name=$_SESSION['user_name'];
$result=mysqli_query($con,"SELECT id FROM users WHERE username='".$user_name."'"); 
$row=mysqli_fetch_array($result);
$sellerid=$row['id'];
//if(isset($_POST['post'])){
//if(isset($_POST['upload']))
//{
  $product_name = $_POST['product_name'];
 

  $description = $_POST['description'];
  

  

  $category = $_POST['category'];


  $quantity = $_POST['quantity'];
  $SESSION['quantity']=$quantity;
  
  
  $target = "img/product_img/".basename($_FILES['image']['name']);
  $image= $_FILES['image']['name'];
  
  
  $query = "INSERT INTO product_info(sellerid, productname, productimage, category, quantity, description)VALUES('".$sellerid."','". $product_name . "','" . $image . "','" . $category . "','" . $quantity . "','" . $description. "')";
  mysqli_query($con, $query); 
  
  
    
  
   
 $_SESSION['sellerid']=$sellerid;   
    
 move_uploaded_file($_FILES['image']['tmp_name'], $target);
echo "<script> location.href='home1.php'; </script>";
        exit;
    
    
//}
 
//}

?>
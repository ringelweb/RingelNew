<?php
ob_start(); //Turns on output buffering
session_start();

$timezone = date_default_timezone_set("Asia/Kolkata");
 $con = mysqli_connect("localhost","u153289376_root","u153289376_root","u153289376_root");  //connection variable

 if(mysqli_connect_errno())
 {
 	echo "Failed to connect ".mysqli_connect_errno();
 }
 ?>
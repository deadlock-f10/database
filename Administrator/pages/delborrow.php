<?php
$con = mysqli_connect("localhost","root","","library");
										mysqli_query($con,"set character set 'utf8'");//读库 
										mysqli_query($con,"set names 'utf8'");//写库 
if (!$con) {
	die('Could not connect: ' . mysql_error());
	}
    $id=$_POST['del'];
    $exec="delete * from borrow where userid=$id";
    $result=mysqli_query($con,$exec);
?>

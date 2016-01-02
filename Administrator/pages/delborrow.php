<?php
$con = mysqli_connect("localhost","root","","library");
if (!$con) {
	die('Could not connect: ' . mysql_error());
	}
    $id=$_POST['del'];
    $exec="delete * from borrow where userid=$id";
    $result=mysqli_query($con,$exec);
?>
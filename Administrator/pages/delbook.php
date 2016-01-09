<?php
	$con = mysqli_connect("localhost","root","","library");
	mysqli_query($con,"set character set 'utf8'");//¶Á¿â 
	mysqli_query($con,"set names 'utf8'");//Ð´¿â 
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
	$a = $_GET['id'];
	if($a)
	{
		mysqli_query($con,"DELETE FROM `book-information` WHERE `ISBN`=$a");
	    echo"<script>alert('É¾³ý³É¹¦!');location.href=book.php';</script>"; 
	}
	 echo "<script>location.href='book.php';</script>";
?>
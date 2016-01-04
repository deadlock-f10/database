<html>
<head>
<meta charset="utf-8">
    <title>查询结果</title>
<style>

body {
    width: 600px;
    margin: 40px auto;
    font-family: 'trebuchet MS', 'Lucida sans', Arial;
    font-size: 14px;
    color: #444;
}

table {
    *border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    width: 100%;    
}

.bordered {
    border: solid #ccc 1px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 0 1px 1px #ccc; 
    -moz-box-shadow: 0 1px 1px #ccc; 
    box-shadow: 0 1px 1px #ccc;         
}

.bordered tr:hover {
    background: #fbf8e9;
    -o-transition: all 0.1s ease-in-out;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -ms-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;     
}    
    
.bordered td, .bordered th {
    border-left: 1px solid #ccc;
    border-top: 1px solid #ccc;
    padding: 10px;
    text-align: left;    
}

.bordered th {
    background-color: #dce9f9;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ebf3fc), to(#dce9f9));
    background-image: -webkit-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:    -moz-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:     -ms-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:      -o-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:         linear-gradient(top, #ebf3fc, #dce9f9);
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset; 
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
    border-top: none;
    text-shadow: 0 1px 0 rgba(255,255,255,.5); 
}

.bordered td:first-child, .bordered th:first-child {
    border-left: none;
}

.bordered th:first-child {
    -moz-border-radius: 6px 0 0 0;
    -webkit-border-radius: 6px 0 0 0;
    border-radius: 6px 0 0 0;
}

.bordered th:last-child {
    -moz-border-radius: 0 6px 0 0;
    -webkit-border-radius: 0 6px 0 0;
    border-radius: 0 6px 0 0;
}

.bordered th:only-child{
    -moz-border-radius: 6px 6px 0 0;
    -webkit-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
}

.bordered tr:last-child td:first-child {
    -moz-border-radius: 0 0 0 6px;
    -webkit-border-radius: 0 0 0 6px;
    border-radius: 0 0 0 6px;
}

.bordered tr:last-child td:last-child {
    -moz-border-radius: 0 0 6px 0;
    -webkit-border-radius: 0 0 6px 0;
    border-radius: 0 0 6px 0;
}
  
</style>
</head>

<body>
<?php
function ConnectDatabase($database){
$con = mysqli_connect("localhost","root","",$database);
										mysqli_query($con,"set character set 'utf8'");//读库 
										mysqli_query($con,"set names 'utf8'");//写库 
if (!$con){
  	die('Could not connect: ' . mysqli_error());
}
  return $con;
}
function CloseDatabase($con){
	 mysqli_close($con);
	 return;
}
?>

<h2>续借结果</h2>
<table class="bordered">
    <thead>

    <tr>
        <th>书名</th>        
        <th>作者</th>
        <th>摘要</th>
    </tr>
	
    </thead>
	
	    
	<?php
	$con=ConnectDatabase("library");
	$userid=$_POST["userid"];
	//echo $userid;
	$callnumber=array();
	$callnumber=$_POST["callnumber"];
	for($x=0;$x<count($callnumber);$x++){
		$judgetime=false;  //判断续借次数是否到限
		$judgereserve=false; //判断是否这本书有预约
		//echo $callnumber[$x];
		//检测是否续借次数到限
		$sql="SELECT `returntime` FROM `borrow` WHERE `userid`='$userid' and `callnumber`='$callnumber[$x]' and `renewaltimes`<
		(SELECT `renewalnumber` FROM `user-level` WHERE `level` in
		(SELECT `level` FROM `user-information` WHERE userid='$userid'));";
		//echo $sql;
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		$returntime=$row["returntime"];
		//echo "returntime:".$returntime;
		if(!$returntime){$judgetime=true;}
		//$abc=$judgetime?'true':'false';
		//echo $abc;
		//哦按段这本书是否有预约
		$sql="SELECT `reservationnumber` FROM `book-information` WHERE `callnumber`='$callnumber[$x]';";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		$reservationnumber=$row["reservationnumber"];
		if($reservationnumber!=0) $judgereserve=true;
		if($judgereserve||$judgetime){
			echo "<tr><td><font style=\"color:red\">否</font></td>";
			$sql="SELECT `name` FROM `book-information` WHERE callnumber='".$callnumber[$x]."';";
			$result = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($result);
			$name=$row["name"];
			echo "<td>";
			echo $name;
			echo "</td><td><font style=\"color:red\">";
			if($judgetime) echo "续借到期";
			else if($judgereserve) echo "已有预约";
			echo "</font></td>";
		}
		else{
			//可以续借，输出相关续借信息，即还书时间等
			$sql="SELECT `renewaltimes` FROM `borrow` WHERE userid=$userid and callnumber='$callnumber[$x]';";
			$result = mysqli_query($con,$sql);
		    $row = mysqli_fetch_array($result);
			$renewaltimes=$row["renewaltimes"]+1;
			mysqli_query($con,"SET AUTOCOMMIT=0"); 
			$sql="UPDATE `borrow` SET `renewaltimes`=$renewaltimes WHERE userid=$userid and callnumber='$callnumber[$x]';";
			$result1=mysqli_query($con,$sql);
			$returntime=date("Y-m-d", strtotime("+1 months", strtotime($returntime)));
			//echo $returntime;
			$sql="UPDATE `borrow` SET `returntime`='$returntime' WHERE userid=$userid and callnumber='$callnumber[$x]';";
			//echo $sql;
			$result2=mysqli_query($con,$sql);
			if($result1 && $result2){
				mysqli_query($con,"COMMIT");
				//echo '提交成功。';
				}else{
					mysqli_query($con,"ROLLBACK");
					//echo '数据回滚。';
					}
				mysqli_query($con,"END"); 
				mysqli_query($con,"SET AUTOCOMMIT=1");
			echo "<tr><td>是</td>";
			$sql="SELECT `name` FROM `book-information` WHERE callnumber='$callnumber[$x]';";
			$result = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($result);
			$name=$row["name"];
			echo "<td>";
			echo $name;
			echo "</td>";
			echo "<td>";
			echo "shabi";
			echo "</td>";
		}
	}
	CloseDatabase($con);
	?>
</table>

</body>
</html>

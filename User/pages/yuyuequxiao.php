<html>
<head>
<meta charset="utf-8">
    <title>预约取消</title>
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

<h2>预约已取消，以下为取消订单详情</h2>
<table class="bordered">
    <thead>

    <tr>
        <th>序号</th>        
        <th>书名</th>
        <th>操作日期</th>
    </tr>
	
    </thead>
	<?php
	$con=ConnectDatabase("library");
	$userid=$_POST["userid"];
	//echo $userid;
	$callnumber=array();
	$callnumber=$_POST["callnumber"];
	//取消预约，分三步，第一该预约记录删除，第二这本书预约人数少一人，第三这本书排在他之后预约的人次序减一借书时间减一个月
	for($x=0;$x<count($callnumber);$x++){
		mysqli_query($con,"LOCK TABLES `book-information` WRITE");
		mysqli_query($con,"LOCK TABLES `reservation` WRITE");
		//mysqli_query($con,"SET AUTOCOMMIT=0"); 
		$sql="UPDATE `book-information` SET `reservationnumber`=`reservationnumber`-1 WHERE callnumber='$callnumber[$x]';";
		//$result1=mysqli_query($con,$sql);
		$sql="SELECT `queuenumber` FROM `reservation` WHERE userid=$userid and callnumber='$callnumber[$x]';";
		//echo $sql;
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		$queuenumber=$row[0];
		$sql="DELETE FROM `reservation` WHERE userid=$userid and callnumber='$callnumber[$x]';";
		//$result2=mysqli_query($con,$sql);
		$sql="UPDATE `reservation` SET `queuenumber`=`queuenumber`-1,`timetoget`=DATE_ADD(timetoget,INTERVAL -1 MONTH) WHERE `callnumber`='$callnumber[$x]' and queuenumber>$queuenumber;";
		//$result3=mysqli_query($con,$sql);
		/*if($result1 && $result2 && $result3){
				mysqli_query($con,"COMMIT");
				//echo '提交成功。';
				}else{
					mysqli_query($con,"ROLLBACK");
					//echo '数据回滚。';
					}
				mysqli_query($con,"END"); 
				mysqli_query($con,"SET AUTOCOMMIT=1");*/
				mysqli_query($con,"UNLOCK TABLES");//
		echo "<tr>";
		echo "<td>";
		echo $x+1;
		echo "</td>";
		$sql="SELECT `name` FROM `book-information` WHERE callnumber='".$callnumber[$x]."';";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		$name=$row["name"];
		echo "<td>";
		echo $name;
		echo "</td>";
		echo "<td>";
		$time = time();
		echo date("y-m-d",$time);
        echo "</td>";	
		echo "</tr>";	
		 //插入历史表
	    $history_sql="INSERT INTO `history`(`userid`, `callnumber`, `time`, `type`) VALUES ('$userid','$callnumber[$x]','$time','取消预约')";
		 if (mysqli_query($con, $history_sql)) { }	
	}
	CloseDatabase($con);
	?>
</table>

</body>
</html>

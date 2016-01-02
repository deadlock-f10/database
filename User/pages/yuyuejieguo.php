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

<h2>预约结果</h2>
<table class="bordered">
    <thead>
    <tr>
        <th>索书号</th>        
        <th>书名</th>
        <th>已预约</th>
        <th>到期时间</th>
    </tr>
	
    </thead>
	
	    
	<?php
	$con=ConnectDatabase("library");
	$userid=$_POST["userid"];
	//echo $userid;
	$callnumber=array();
	$callnumber=$_POST["callnumber"];

	for($x=0;$x<count($callnumber);$x++){
		$num=$callnumber[$x];
	echo "<tr>";
		//图书信息查询
		$sql="SELECT * FROM `book-information` where `callnumber`='$num';";
		$result = mysqli_query($con,$sql);
		$row1 = mysqli_fetch_array($result);
		//预约信息查询
		$sql="SELECT * FROM `reservation` where `callnumber`='$num';";
		$result = mysqli_query($con,$sql);
		$row2 = mysqli_fetch_array($result);
		$queue=$row2['queuenumber'];
		//预约时间查询
		$sql=" SELECT  `timetoget` FROM `reservation` where `callnumber`='$num' ";
		$result = mysqli_query($con,$sql);
		$row3 = mysqli_fetch_array($result);
		if( empty($row3) ){  
		    $time= date('Y-m-d');
		}
		else {
			$time = $row3['timetoget'];
		}
		
		//预约队列增加一个人
		$queue=$queue+1;
		//预约时间增加一个月
		$time=date("Y-m-d",strtotime("+1 months",strtotime($time)));
	
	    //插入历史表
	    $history_sql="INSERT INTO `history`(`userid`, `callnumber`, `time`, `type`) VALUES ('$userid','$num','$time','预约')";
		 if (mysqli_query($con, $history_sql)) { }
		 			 
		if ( mysqli_query($con,$sql)&& mysqli_query($con,$sql) ) {
			//索书号
			echo "<td>";
			echo $num;
			echo "</td>";
			//书名
			echo "<td>";
			echo $row1['name'];
			echo "</td>";
		    //插入预约表
			$reservation_sql="INSERT INTO `reservation`(`userid`, `callnumber`, `queuenumber`, `timetoget`) VALUES ('$userid','$num','$queue','$time')";
			if ( mysqli_query($con,$reservation_sql) ) { 
			   	//已预约人数
				echo "<td>";
				echo $queue;
				echo "</td>";
				//到期时间
				echo "<td>";
				$time=date("Y-m-d",strtotime("-1 months",strtotime($time)));
				echo $time;
				echo "</td>";
				}
			 else {
				//已预约人数
				echo "<td>";
				echo "您已预约";
				echo "</td>";
				//到期时间
				echo "<td>";
				$sql=" SELECT  `timetoget` FROM `reservation` where `userid`='$userid' and `callnumber`='$num'";
				$result = mysqli_query($con,$sql);
				$row4 = mysqli_fetch_array($result);
				echo $row4['timetoget'];
				echo "</td>";
				}
	 }
	else {
			echo "<td>";
			echo "预约失败";
			echo "<td>";
		}
	echo "</tr>";
	}
	CloseDatabase($con);
	?>
</table>

</body>
</html>

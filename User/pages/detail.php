<html>
<head>
<meta charset="utf-8">
    <title>图书详情</title>
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
	text-align: center;
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
    //error_reporting(0);
    //include("search.php");
	if($_GET['id'])
	{
		$id=$_GET['id'];
	}

   //创建连接
   $servername="localhost";
   $username="root";
   $password="";
   $dbname="library";
   $conn=mysqli_connect($servername,$username,$password,$dbname);
										mysqli_query($con,"set character set 'utf8'");//读库 
										mysqli_query($con,"set names 'utf8'");//写库 
   if(!$conn){
	   die("connection failed".mysqli_correct_error());
   }

 ?>
<h2>以下是图书详细信息</h2>
<table class="bordered">
    <thead>
       <tr>
          <th width="34%" weight='50 px'>名称</th>        
          <th width="66%">图书</th>
       </tr>
    </thead>
    <tbody>
    <?php $sql="SELECT * FROM `book-information` WHERE `callnumber`='$id'";
	      $rs= mysqli_query($conn,$sql);
	      $row=mysqli_fetch_array($rs); ?>
     </tr>
        <td><?php   echo "索书号"; ?></td>
        <td><?php echo $row['callnumber']; ?></td>
    </tr></tr>
        <td><?php   echo "书名"; ?></td>
        <td><?php echo $row['name']; ?></td>
    </tr>	
    </tr>
        <td><?php   echo "作者"; ?></td>
        <td><?php echo $row['firstauthor']; ?></td>
    </tr>
    </tr>
        <td><?php   echo "主题词"; ?></td>
        <td><?php echo $row['subject1']." ".$row['subject2']." ".$row['subject3']." ".$row['subject4']." ".$row['subject5']." "; ?></td>
    </tr>
    </tr>
        <td><?php   echo "出版社"; ?></td>
        <td><?php echo $row['publisher']; ?></td>
    </tr>	
    </tr>
        <td><?php   echo "出版时间"; ?></td>
        <td><?php echo $row['publishtime']; ?></td>
    </tr>
     <?php $sql="SELECT * FROM `book-location` WHERE `callnumber`='$id'";
	      $rs= mysqli_query($conn,$sql);
	      $row=mysqli_fetch_array($rs); ?>
    </tr>
        <td><?php   echo "馆藏位置"; ?></td>
        <td><?php echo $row['location']; ?></td>
    </tr>
     <?php 
	      if ($row['isborrowed']='1') {$borrow="已借出";} 
		  else {$borrow="未借出";}
	 ?>
     </tr>
        <td><?php   echo "在馆状态"; ?></td>
        <td><?php echo $borrow; ?></td>
     </tr>
     <?php 
	      if ($row['iscircled']='1') {$circle="可流通";} 
		  else {$circle="非流通";}
	 ?>
     </tr>
        <td><?php   echo "流通状态"; ?></td>
        <td><?php echo $circle; ?></td>
     </tr>
     </tbody>
</table>

</body>
</html>

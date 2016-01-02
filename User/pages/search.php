

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>用户个人界面</title>

     <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	 <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

	
    <script language="javascript" type="text/javascript">
	function ck(b)
{
    var input = document.getElementsByTagName("input");

    for (var i=0;i<input.length ;i++ )
    {
        if(input[i].type=="checkbox")
            input[i].checked = b;
    }
}
function check(value)
{
	if(value=="高级检索")
	{
	  document.getElementById('高级检索').style.display="block";
	  document.getElementById('借阅状态').style.display="none";
	  document.getElementById('续借').style.display="none";
	  document.getElementById('预约取消').style.display="none";
	  document.getElementById('借阅历史').style.display="none";
	  document.getElementById('其他服务').style.display="none";
	}	
	else if(value=="借阅状态")
	{
	  document.getElementById('高级检索').style.display="none";
	  document.getElementById('借阅状态').style.display="block";
	  document.getElementById('续借').style.display="none";
	  document.getElementById('预约取消').style.display="none";
	  document.getElementById('借阅历史').style.display="none";
	  document.getElementById('其他服务').style.display="none";
	}
	else if(value=="续借")
	{
	  document.getElementById('高级检索').style.display="none";
	  document.getElementById('借阅状态').style.display="none";
	  document.getElementById('续借').style.display="block";
	  document.getElementById('预约取消').style.display="none";
	  document.getElementById('借阅历史').style.display="none";
	  document.getElementById('其他服务').style.display="none";
	}
	else if(value=="预约取消")
	{
	 document.getElementById('高级检索').style.display="none";
	  document.getElementById('借阅状态').style.display="none";
	  document.getElementById('续借').style.display="none";
	  document.getElementById('预约取消').style.display="block";
	  document.getElementById('借阅历史').style.display="none";
	  document.getElementById('其他服务').style.display="none";
	}
	else if(value=="借阅历史"){
	  document.getElementById('高级检索').style.display="none";
	  document.getElementById('借阅状态').style.display="none";
	  document.getElementById('续借').style.display="none";
	  document.getElementById('预约取消').style.display="none";
	  document.getElementById('借阅历史').style.display="block";
	  document.getElementById('其他服务').style.display="none";
	}
	else{
	  document.getElementById('高级检索').style.display="none";
	  document.getElementById('借阅状态').style.display="none";
	  document.getElementById('续借').style.display="none";
	  document.getElementById('预约取消').style.display="none";
	  document.getElementById('借阅历史').style.display="none";
	  document.getElementById('其他服务').style.display="block";
	}
}
</script>
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

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">欢迎来到三味书屋</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<!-- 获得用户姓名 -->
					<?php
					$con = ConnectDatabase("library");
					$sql="SELECT name FROM `user-information` WHERE userid=".$_POST["userid"]." and password='".$_POST["password"]."' and approvalstatus=1;";
					//echo $sql;
					$result = mysqli_query($con,$sql);
					$row = mysqli_fetch_array($result);
					if(!$row["name"]) {
						echo '<script>location.href="loginfail.html"</script>';
						echo '<meta http-equiv="Refresh" content="0,url=loginfail.html"/>';
						header('Location:loginfail.html');
					}
					echo $row["name"];
					CloseDatabase($con);
					
					//echo "罗晶";
					?>
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> 用户资料</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> 用户设置</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> 退出登陆</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       <li>
                            <a><i class="fa fa-dashboard fa-fw"></i><input type="button" class="button" value="高级检索" onClick="javascript:check(this.value);"></a>
                        </li> 
                        <li>
                            <a><i class="fa fa-dashboard fa-fw"></i><input type="button" class="button" value="借阅状态" onClick="javascript:check(this.value);"></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>&nbsp;&nbsp;续借<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <input type="button" class="button1" value=""><input type="button" class="button" value="续借" onClick="javascript:check(this.value);">
                                </li>
                                <li>
                                    <input type="button" class="button1" value=""><input type="button" class="button" value="预约取消" onClick="javascript:check(this.value);">
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a><i class="fa fa-table fa-fw"></i><input type="button" class="button" value="借阅历史" onClick="javascript:check(this.value);"></a>
                        </li>
                        <li>
                            <a><i class="fa fa-edit fa-fw"></i><input type="button" class="button" value="馆际互借提交申请" onClick="javascript:check(this.value);"></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> 服务<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <input type="button" class="button1" value=""><input type="button" class="button" value="入关指南" onClick="javascript:check(this.value);">
                                </li>
                                <li>
                                    <input type="button" class="button1" value=""><input type="button" class="button" value="借阅服务" onClick="javascript:check(this.value);">
                                </li>
                                <li>
                                    <input type="button" class="button1" value=""><input type="button" class="button" value="精彩讲座" onClick="javascript:check(this.value);">
                                </li>
                                <li>
                                    <input type="button" class="button1" value=""><input type="button" class="button" value="研究咨询" onClick="javascript:check(this.value);">
                                </li>
                                <li>
                                    <input type="button" class="button1" value=""><input type="button" class="button" value="学科服务" onClick="javascript:check(this.value);">
                                </li>
                                <li>
                                    <input type="button" class="button1" value=""><input type="button" class="button" value="学位论文提交" onClick="javascript:check(this.value);">
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa fa-sitemap fa-fw"></i> 资源<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <input type="button" class="button1" value=""><input type="button" class="button" value="电子资源" onClick="javascript:check(this.value);">	
                                </li>
                                <li>
                                    <input type="button" class="button1" value=""><input type="button" class="button" value="纸质资源" onClick="javascript:check(this.value);">
                                </li>
								<li>
                                    <input type="button" class="button1" value=""><input type="button" class="button" value="数字特藏" onClick="javascript:check(this.value);">
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> 推荐<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <input type="button" class="button1" value=""><input type="button" class="button" value="推荐书单" onClick="javascript:check(this.value);">
                                </li>
                                <li>
                                    <input type="button" class="button1" value=""><input type="button" class="button" value="猜你喜欢" onClick="javascript:check(this.value);">
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

       <!-- 高级检索 -->
	    <div id="高级检索">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">检索结果</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<?php
				  //获取input.php中的文本
				   $search_word=$_POST['search_word'];
				   $writer=$_POST['writer'];
				   $title=$_POST['title'];
				   $ISBN=$_POST['ISBN'];
				   $publisher=$_POST['publisher'];
				   $year=$_POST['year'];
				   $type=$_POST['type'];
				   $display= array(); 
				   /*$display= $_POST['display']; 
				   echo '你选择了:'.implode(',',$display); 
				   $undisplay= array(); 
				   $undisplay = $_POST['undisplay']; 
				   echo '你选择了:'.implode(',',$undisplay); */
				
				   //创建连接
				   $servername="localhost";
				   $username="root";
				   $password="";
				   $dbname="library";
				   $conn=mysqli_connect($servername,$username,$password,$dbname);
				   if(!$conn){
					   die("connection failed".mysqli_correct_error());
				   }
				
					 $subjectsql="select callnumber from `library`.`book-information` where `subject1` like '%$search_word%' or `subject2` like '%$search_word%' or `subject3` like '%$search_word%' or `subject4` like '%$search_word%' or `subject5` like '%$search_word%'";
					 
					 $infosql="select callnumber from `library`.`book-information` where firstauthor like '%$writer%' and name like '%$title%' and  ISBN like '%$ISBN%' and publisher like '%$publisher%'";
					 
					 if($year='1')
					 {
						 $yearsql="select callnumber from `library`.`book-information` ";
					 }	
					 else if($year='2')
					 {
						 $yearsql="select callnumber from `library`.`book-information` where `publishtime`<1990 ORDER BY `publishtime` ASC";
					 }
					 else if($year='3')
					 {
						 $yearsql="select callnumber from `library`.`book-information` where `publishtime` between 1990 and 2000 ORDER BY `publishtime` ASC";
					 }
					  else if($year='4')
					 {
						 $yearsql="select callnumber from `library`.`book-information` where `publishtime` between 2000 and 2005 ORDER BY `publishtime` ASC";
					 }
					  else if($year='5')
					 {
						 $yearsql="select callnumber from `library`.`book-information` where `publishtime` between 2005 and 2010 ORDER BY `publishtime` ASC";
					 }
					 else if($year='6')
					 {
						 $yearsql="select callnumber from `library`.`book-information` where `publishtime` >2010 ORDER BY `publishtime` ASC";
					 }
					 
					
					 $rs1=mysqli_query($conn,$infosql);  
					 $r1=array();
					 $i=0;
					 while($row = mysqli_fetch_array($rs1))
					 {
						  $r1[$i]=$row['callnumber'];
						  $i++; 
					 }
				
					
					 $rs2=mysqli_query($conn,$yearsql);  
					 $r2=array();
					 $i=0;
					 while($row = mysqli_fetch_array($rs2))
					 {
						  $r2[$i]=$row['callnumber'];
						  $i++; 
					 }
				
				
					 $rs3=mysqli_query($conn,$subjectsql);  
					 $r3=array();
					 $i=0;
					 while($row = mysqli_fetch_array($rs3))
					 {
						  $r3[$i]=$row['callnumber'];
						  $i++; 
					 }
				
					  
					 
					 $r12=array_intersect($r1, $r2);
					 $union=array_intersect($r12, $r3);
					 
					 
					 /*显示与不显示
					 if( $_POST ) 
					 { 
						 $value = $_POST['display']; 
						 print_r($value);
						 foreach ($value as $v){ echo $v." ";}  
					}
					*/ 
				
				 ?>
				<FORM action="yuyuejieguo.php" METHOD="post" target=_blank>
				<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
						    <input type="button" class="submit" onClick="ck(true)" value="全选">
							<input type="button" class="submit" onClick="ck(false)" value="取消全选">
                            <input type="submit" class="submit" value="预约"  >
			    <?php
					echo "<input type=\"text\" name=\"userid\" class=\"submit\" style=\"display:none\" value=".$_POST["userid"].">";				?>
							

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="26%">书名</th>
                                            <th width="74%">摘要</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                      <?php  
						   foreach( $union as $data)
						   {
					  ?>
					  <tr>
						 <?php $sql="SELECT * FROM `book-information` WHERE `callnumber`='$data'";
							   $rs= mysqli_query($conn,$sql);
							   $row=mysqli_fetch_array($rs); 
						       echo "<tr class=\"odd gradeX\">";
						       echo "<td><INPUT TYPE=\"checkbox\" NAME=\"callnumber[]\" value=\"".$row['callnumber']."\">&nbsp;&nbsp;";     			echo "<a href=detail.php?id=".$row['callnumber'].">".$row['name']."</a>";
						echo "</INPUT></td>";
						echo "<td>";
						echo $row["abstract"];
						echo "</td>";
					}
					CloseDatabase($con);									
						?>
                                    </tbody>
                                </table>
                                                          </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			</FORM>
                            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
		</div>
		
		
		
		<!-- 借阅状态 -->
	   <div id="借阅状态" style="display:none;">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">借阅状态</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            书中自有颜如玉，要多多读书哦~
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>书名</th>
                                            <th>作者</th>
											<th>语言</th>
                                            <th>借书日期</th>
                                            <th>还书日期</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<!--
                                        <tr class="odd gradeX">
                                            <td>数据库</td>
                                            <td>陈文广</td>
                                            <td>中文</td>
                                            <td class="center">2015-03-01</td>
                                            <td class="center">2015-06-22</td>
                                        </tr>
									-->	
                                        <?php
		            $con=ConnectDatabase("library");
					$sql="select callnumber,borrowtime,returntime from borrow where userid='".$_POST["userid"]."'";
					$result = mysqli_query($con,$sql);
					while($row = mysqli_fetch_array($result)){
						$sql="SELECT * FROM `book-information` WHERE callnumber='".$row["callnumber"]."';";
						//echo $sql;
						$results = mysqli_query($con,$sql);
						$rows = mysqli_fetch_array($results);
						echo "<tr class=\"odd gradeX\">";
						echo "<td>";
						echo $rows["name"];
						echo "</td>";
						echo "<td>";
						echo $rows["firstauthor"];
						echo "</td>";
						echo "<td>";
						echo $rows["language"];
						echo "</td>";
						echo "<td class=\"center\">";
						echo $row["borrowtime"];
						echo "</td>";
						echo "<td class=\"center\">";
						echo $row["returntime"];
						echo "</td>";
					}
					CloseDatabase($con);									
										?>
										
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
		</div>
		
		
		<!-- 续借 -->
	   <div id="续借" style="display:none;">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">续借</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				
				<FORM action="xujie.php" METHOD="post" target=_blank>
				<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
						    <input type="button" class="submit" onClick="ck(true)" value="全选">
							<input type="button" class="submit" onClick="ck(false)" value="取消全选">
                            <input type="submit" class="submit" value="续借"  onclick='window.location.reload()'>
							
							<?php
							echo "<input type=\"text\" name=\"userid\" class=\"submit\" style=\"display:none\" value=".$_POST["userid"].">";
							?>
							

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>书名</th>
                                            <th>作者</th>
											<th>语言</th>
                                            <th>借书日期</th>
                                            <th>还书日期</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<!--
                                        <tr class="odd gradeX">
                                            <td><INPUT TYPE="checkbox" NAME="数据库的id">&nbsp;&nbsp;数据库</INPUT></td>
                                            <td>陈文广</td>
                                            <td>中文</td>
                                            <td class="center">2015-03-01</td>
                                            <td class="center">2015-06-22</td>
                                        </tr>
									-->	
                                        <?php
		            $con=ConnectDatabase("library");
					$sql="select callnumber,borrowtime,returntime from borrow where userid=".$_POST["userid"];
					$result = mysqli_query($con,$sql);
					while($row = mysqli_fetch_array($result)){
						$sql="SELECT * FROM `book-information` WHERE callnumber='".$row["callnumber"]."';";
						$results = mysqli_query($con,$sql);
						$rows = mysqli_fetch_array($results);
						echo "<tr class=\"odd gradeX\">";
						echo "<td><INPUT TYPE=\"checkbox\" NAME=\"callnumber[]\" value=\"".$row["callnumber"]."\">&nbsp;&nbsp;";
						echo $rows["name"];
						echo "</INPUT></td>";
						echo "<td>";
						echo $rows["firstauthor"];
						echo "</td>";
						echo "<td>";
						echo $rows["language"];
						echo "</td>";
						echo "<td class=\"center\">";
						echo $row["borrowtime"];
						echo "</td>";
						echo "<td class=\"center\">";
						echo $row["returntime"];
						echo "</td>";
					}
					CloseDatabase($con);									
										?>
										
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			</FORM>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
		</div>
		
		
		<!-- 预约取消 -->
	   <div id="预约取消" style="display:none;">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">预约取消</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<FORM action="yuyuequxiao.php" METHOD="post" target=_blank>
				<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
						    <input type="button" class="submit" onClick="ck(true)" value="全选">
							<input type="button" class="submit" onClick="ck(false)" value="取消全选">
                            <input type="submit" class="submit" value="取消预约" onclick='window.location.reload()'>
							
							<?php
							echo "<input type=\"text\" name=\"userid\" class=\"submit\" style=\"display:none\" value=\"".$_POST["userid"]."\">";
							?>
							
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>书名</th>
                                            <th>作者</th>
											<th>语言</th>
                                            <th>排队序号</th>
											<th>借书日期</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<!--
                                        <tr class="odd gradeX">
                                            <td><INPUT TYPE="checkbox" NAME="数据库的id">&nbsp;&nbsp;数据库</INPUT></td>
                                            <td>陈文广</td>
                                            <td>中文</td>
                                            <td class="center">5</td>
                                            <td class="center">2015-06-22</td>
                                        </tr>
									-->	
                                        <?php
		            $con=ConnectDatabase("library");
					$sql="select callnumber,queuenumber,timetoget from reservation where userid=".$_POST["userid"];
					$result = mysqli_query($con,$sql);
					while($row = mysqli_fetch_array($result)){
						$sql="SELECT * FROM `book-information` WHERE callnumber='".$row["callnumber"]."';";
						$results = mysqli_query($con,$sql);
						$rows = mysqli_fetch_array($results);
						echo "<tr class=\"odd gradeX\">";
						echo "<td><INPUT TYPE=\"checkbox\" NAME=\"callnumber[]\" value=\"".$row["callnumber"]."\">&nbsp;&nbsp;";
						echo $rows["name"];
						echo "</INPUT></td>";
						echo "<td>";
						echo $rows["firstauthor"];
						echo "</td>";
						echo "<td>";
						echo $rows["language"];
						echo "</td>";
						echo "<td class=\"center\">";
						echo $row["queuenumber"];
						echo "</td>";
						echo "<td class=\"center\">";
						echo $row["timetoget"];
						echo "</td>";
					}
					CloseDatabase($con);									
										?>
										
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			</FORM>
				
				
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
		</div>
		
		
		<!-- 借阅历史 -->
	   <div id="借阅历史" style="display:none;">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">借阅历史</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            你已经读过这么多书了哦~
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>书名</th>
                                            <th>作者</th>
											<th>语言</th>
                                            <th>借书日期</th>
                                            <th>还书日期</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td>数据库</td>
                                            <td>陈文广</td>
                                            <td>中文</td>
                                            <td class="center">2015-03-01</td>
                                            <td class="center">2015-06-22</td>
                                        </tr>
										<!--
                                        <?php
		            $con=ConnectDatabase("library");
					$sql="select callnumber,borrowtime,returntime from borrow where userid=".$_POST["userid"];
					$result = mysqli_query($con,$sql);
					while($row = mysqli_fetch_array($result)){
						$sql="select name,firstauthor,language from book-information where callnumber=".$row["callnumber"];
						$results = mysqli_query($con,$sql);
						$rows = mysqli_fetch_array($results);
						echo "<tr class=\"odd gradeX\">";
						echo "<td>";
						echo $rows["name"];
						echo "</td>";
						echo "<td>";
						echo $rows["firstauthor"];
						echo "</td>";
						echo "<td>";
						echo $rows["language"];
						echo "</td>";
						echo "<td class=\"center\">";
						echo $row["borrowtime"];
						echo "</td>";
						echo "<td class=\"center\">";
						echo $row["returntime"];
						echo "</td>";
					}
					CloseDatabase($con);									
										?>
										-->
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
		</div>
		
		
		<!-- 其他服务 -->
	   <div id="其他服务" style="display:none;">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">等待我们不断升级~~</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
		</div>
    </div>
    <!-- /#wrapper -->

   <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
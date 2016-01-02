
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
                        <h1 class="page-header">高级检索</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<form action="search.php" method="post">
                                        <div class="form-group">
                                            <label>主题词：</label>
                                            <input class="form-control" name="search_word">
                                            <p class="help-block">请在输入框中输入主题词.</p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>著者：</label>
                                            <input class="form-control" name="writer" placeholder="请输入著者姓名">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>标题中：</label>
                                            <input class="form-control" name="title" placeholder="请输入标题">
                                        </div>
                                      
                                        <div class="form-group">
                                            <label>ISBN：</label>
                                            <input class="form-control" name="ISBN" placeholder="请输入ISBN">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>从该地出版：</label>
                                            <input class="form-control" name="publisher" placeholder="请输入出版商">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>出版年份：</label>
                                            <select class="form-control" name="year">
                                                <option value='1'>不限</option>
                                                <option value='2'>1990以前</option>
                                                <option value='3'>1990-2000</option>
                                                <option value='4'>2000-2005</option>
                                                <option value='5'>2005-2010</option>
                                                <option value='6'>2010-</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label >显示以下类型的结果：</label>
                                            <select class="form-control" name="type">
                                                <option  value="1">书籍</option>
                                                <option  value="2">报刊</option>
                                                <option  value="3">学位论文</option>
                                                <option  value="4">古籍</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>只显示：</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="display[]" value="1">馆藏纸质资源
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="display[]" value="2">在线电子资源
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="display[]" value="3">馆际互借资源
                                                </label>
                                            </div>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>不显示：</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="undisplay[]" value="1">报刊文章
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="undisplay[]" value="2">书评
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="undisplay[]" value="3">学位论文
                                                </label>
                                            </div>
                                        </div>
               <?php
	       echo "<input type=\"text\" name=\"userid\" class=\"submit\" style=\"display:none\" value=\"".$_POST["userid"]."\">";
		   echo "<input type=\"text\" name=\"password\" class=\"submit\" style=\"display:none\" value=\"".$_POST["password"]."\">";                 ?>
                                        <button type="submit" class="btn btn-default">提交搜索</button>
                                        <button type="reset" class="btn btn-default">重新输入</button>
                                    </form>
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
				
				<FORM action="yuyuejiguo.php" METHOD="post" target=_blank>
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
                                            <th>索书号</th>
                                            <th>操作</th>
                                            <th>时间</th>
                                        </tr>
                                    </thead>
                                    <tbody>
					<?php
		            $con=ConnectDatabase("library");
					$sql="select * from history where userid=".$_POST["userid"];
					$result1 = mysqli_query($con,$sql);
					while($row1 = mysqli_fetch_array($result1)){
						$callnumber=$row1["callnumber"];
						echo "<tr class=\"odd gradeX\">";
						echo "<td>";
						echo "<a href=detail.php?id=".$row1['callnumber'].">".$row1['callnumber']."</a>";
						//echo $callnumber;
						echo "</td>";
						echo "<td>";
						echo $row1["type"];
						echo "</td>";
						echo "<td class=\"center\">";
						echo $row1["time"];
						echo "</td>";
						echo "</tr>";
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
<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>三味书屋 - 系统管理员中心</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

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
                <a class="navbar-brand" href="index.html">欢迎来到三味书屋系统管理中心</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<?php
					/*$con=ConnectDatabase("library");
					$sql="select name where userid=".$_POST["userid"];
					$result = mysqli_query($con,$sql);
					$row = mysqli_fetch_array($result);
					$name=$row[0];
					echo $name;*/
					echo "罗晶";
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
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>  <!-- 小search框 -->
                        <li>
                            <a href="borrow.php"><i class="fa fa-dashboard fa-fw"></i> 图书借出</a>                       
                        </li>
						 <li>
                            <a href="return.php"><i class="fa fa-rotate-right fa-fw"></i> 图书归还</a>                          
                        </li>
                        <li>
                            <a href="circulation.php"><i class="fa fa-bar-chart-o fa-fw"></i> 流通情况一览</a>                           
                        </li>
						 <li>
                            <a href="book.php"><i class="fa fa-table fa-fw"></i> 查询/上架/下架图书</a>                           
                        </li>
						 <li>
                            <a href="user.php"><i class="fa fa-user-md fa-fw"></i> 查询/审核/注销读者</a>                       
                        </li>                  
                        <li>
                            <a href="analysis.php"><i class="fa fa-edit fa-fw"></i> 数据分析</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> 权限设置<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="setadministrator.php">管理员权限设置</a>
                                </li>
                                <li>
                                    <a href="setuser.php">读者权限设置</a>
                                </li>                          
                               
                              </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> 帮助</a>
                        </li>
						
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
          <div id="page-wrapper">
			 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">图书信息管理</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<button type="button" class="btn btn-outline btn-success"
							onclick="show('onshelve.php')"><i class="fa  fa-plus-circle fa-fw"></i>新书上架</button>	
							<button type="button" class="btn btn-outline btn-primary"
							onclick="show2('uploadbook.php')"><i class="fa  fa-upload  fa-fw"></i>批量上书</button>													
                        </div>
                        <!-- /.panel-heading -->	
						 <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="tab">
                                    <thead>
                                        <tr>
                                            <th>书名</th>
											<th>第一作者</th>
											<th>其他作者</th>
											<th>索书号</th>
                                            <th>ISBN</th>
                                            <th>出版社</th>
                                            <th>出版时间</th>
                                            <th>语言</th>
											<th>主题词</th>
											<th>操作</th>
											<th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php  
										$con = mysqli_connect("localhost","root","","library");
										mysqli_query($con,"set character set 'utf8'");//读库 
										mysqli_query($con,"set names 'utf8'");//写库 
										if (!$con) {
											die('Could not connect: ' . mysql_error());
											}
										$sql="select * from `book-information`";
										$rs=mysqli_query($con,$sql);
										while($row=mysqli_fetch_array($rs)){
										?>
										<tr>
											<td><?php echo $row['name']?></td>
											<td><?php echo $row['firstauthor']?></td>			<td><?php echo $row['otherauthor']?></td>
											<td><?php echo $row['callnumber']?></td>
											<td><?php echo $row['ISBN']?></td>
											<td><?php echo $row['publisher']?></td>
											<td><?php echo $row['publishtime']?></td>
											<td><?php echo $row['language']?></td>
											<td><?php echo $row['subject1']+" "+$row['subject2']+" "+$row['subject3']+" "+$row['subject4']+" "+$row['subject5']?></td>


											<td onclick="getISBN(this);">	
											<script language="javascript">					 
											function getISBN(h) {
												var hang= h.parentNode.rowIndex;
												//alert(hang);
												var tab=document.getElementById("tab");
												var s=tab.rows[hang].cells[4].innerHTML;
												//alert(s);
												//document.getElementById('m').action = 
												//"circulation.php";
												var url="editbook.php?id="+s; 
												show(url);
												//document.getElementById("m").submit();										
											}
											</script>						
											<button type="button" class="btn btn-outline btn-primary" onclick="">
											<i class="fa fa-edit fa-fw"></i>
											编辑</button>
											</td>
										

								
											<script language="javascript"> 
											function delcfm() { 
												if (!confirm("确认要删除这一条记录吗？")) { 
													window.event.returnValue = false;    } 
													} 
											</script>

											<script language="javascript">					 
											function get(h) {
												var hang= h.parentNode.rowIndex;
												//alert(hang);
												var tab=document.getElementById("tab");
												var s=tab.rows[hang].cells[4].innerHTML;
												//alert(s);
												document.getElementById('m').action = "book.php?id="+s;
												//"circulation.php";
												
												document.getElementById("m").submit();										
											}
											</script>
											<form id="m" action="" method="POST">
											<td onclick="delcfm();get(this);">
											
											
																		
											<button  type="submit" class="btn btn-outline btn-danger" onclick="">
											<i class="fa fa-minus-circle fa-fw"></i>
											删除</button>
											</form>
											</td>
										</tr>	
										<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        
    </div>
    <!-- /#wrapper -->


	<?php
	@$a = $_GET['id'];
	if($a)
	{
		mysqli_query($con,"DELETE FROM `book-information` WHERE `ISBN`=$a");
	    echo"<script>alert('删除成功!');location.href=book.php';</script>"; 
	}
	?>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#tab').DataTable({
                responsive: true
        });
    });
    </script>

	<script type="text/javascript">
	function show(url){
		window.open(url,"newwindow", "height=650, width=600, left=400,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=yes");
	}
	function show2(url){
		window.open(url,"newwindow", "height=300, width=600, left=400,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=yes");
	}
	</script>
	

</body>

</html>

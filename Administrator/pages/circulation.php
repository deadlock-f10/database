<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
					echo "admin";
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
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> 系统维护<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">数据备份</a>
                                </li>
                                <li>
                                    <a href="#">数据还原</a>
                                </li>
                                <li>
                                    <a href="#">数据清理</a>
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
                    <h1 class="page-header">图书流通情况一览</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        </div>
                        <!-- /.panel-heading -->
						 <div class="panel-body">
                            <div class="dataTable_wrapper">
								<form name="frm" action="delborrow.php" method="post">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>用户编号</th>
											<th>用户姓名</th>
											<th>书名</th>
											<th>第一作者</th>
                                            <th>索书号</th>
                                            <th>副本号</th>
                                            <th>借出日期</th>
                                            <th>应还日期</th>
											<th>续借次数</th>
											<!--<th>操作</th>
											<th>操作</th>-->
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
										$sql="select userid,callnumber,	copynumber,borrowtime,returntime,renewaltimes from borrow";
										//echo $sql;
										$rs=mysqli_query($con,$sql);
										while($row=mysqli_fetch_array($rs)){
										?>
										<tr>
											<td>
											<?php echo $row['userid'] ?>
											</td>
											<?php 
											$id = $row['userid'];
											$sql2="SELECT `name` FROM `user-information` WHERE `userid`=$id ";
											$rs2=mysqli_query($con,$sql2);
											$row2=mysqli_fetch_array($rs2); ?>
											<td><?php echo $row2['name']?></td>
											<?php 
											$n=$row['callnumber'];
											$sql3="SELECT * FROM `book-information` WHERE `callnumber`='$n'";
											$rs3=mysqli_query($con,$sql3);
											$row3=mysqli_fetch_array($rs3); ?>				
											<td><?php echo $row3['name']?></td>
											<td><?php echo $row3['firstauthor']?></td>
											<td><?php echo $row['callnumber']?></td>
											<td><?php echo $row['copynumber']?></td>
											<td><?php echo $row['borrowtime']?></td>
											<td><?php echo $row['returntime']?></td>
											<td><?php echo $row['renewaltimes']?></td>
											<!--<td>											
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
											<td>
											<button type="button" class="btn btn-outline btn-danger" onclick="delcfm()">
											<i class="fa fa-minus-circle fa-fw"></i>
											删除</button>
											</td>
											-->

										</tr>	
										<?php } ?>
                                    </tbody>
                                </table>
							    </form>
                            </div>
                        
    </div>
    <!-- /#wrapper -->

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
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>


</body>

</html>

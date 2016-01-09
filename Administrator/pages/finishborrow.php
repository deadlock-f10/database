<!DOCTYPE html>
<html lang="en">

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
					/*$con=mysqli_connect("localhost","root","","library");
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
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> 数据维护<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="backup.php">数据备份</a>
                                </li>
                                <li>
                                    <a href="restore.php">数据还原</a>
                                </li>
								 <li>
                                    <a href="initialization.php">数据初始化</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="help.php"><i class="fa fa-files-o fa-fw"></i> 帮助</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">图书借出</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            图书已借出，详情如下
                        </div>
                        <div class="panel-body">
							<?php
							$userid=$_GET['userid'];
							$callnumber=$_GET['callnumber'];
							$copynumber=$_GET['copynumber'];
							$borrowtime=date("Y-m-d");
							$returntime=date('Y-m-d',strtotime('+30 day'));
							$con=mysqli_connect("localhost","root","","library");
							mysqli_query($con,"set character set 'utf8'");//读库 
							mysqli_query($con,"set names 'utf8'");//写库 
							if (!$con) {	die('Could not connect: ' . mysql_error());}
							$sql="UPDATE `book-location` SET `isborrowed`=1 WHERE `callnumber`=$callnumber,`copynumber`=$copynumber";
							mysqli_query($con,$sql);
							$sql="INSERT INTO `book-location`(`userid`, `callnumber`, `copynumber`, `borrowtime`, `returntime`, `renewaltimes`) VALUES ('$userid','$callnumber','$copynumber','$borrowtime','$returntime','0')";
							mysqli_query($con,$sql);
							?>
						
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="finishborrow.php" role="form" >
                                        
										<div class="form-group">
                                            <label>用户编号：<?php echo $userid; ?></label>
                                        </div>
                                        <div class="form-group" >
                                            <label>索书号：<?php echo $callnumber; ?></label>
                                        </div>
										<div class="form-group" >
                                            <label>副本号：<?php echo $copynumber; ?></label>
                                        </div>
										<div class="form-group" >
                                            <label>借出时间：<?php echo $borrowtime; ?></label>
                                        </div>
										<div class="form-group" >
                                            <label>归还时间：<?php echo $returntime; ?></label>
                                        </div>
                                       <!-- <div id="org"></div> 
                                        <input type="button" class="btn btn-default" onclick="add1();" value="添加" />
                                         <script type="text/javascript">
											function add1(){
    											var input1 = document.createElement('input');
    											 input1.setAttribute('type', 'text');
    											 input1.setAttribute('name', 'books[]');
    										   	 input1.setAttribute('class', 'form-control');
												 input1.setAttribute('placeholder', '图书编号');
    											 var btn1 = document.getElementById("org");
    											btn1.insertBefore(input1,null);
												}
										</script> -->
   
                                        <div align="center" onload="load()"> 
											<input type=button class="btn btn-default" onclick="window.location.href('borrow.php')" value="确认"> 
                                        </div>   
								</form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

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

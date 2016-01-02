<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>新书上架</title>

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
 <div id="page-wrapper">
           <div id="page-wrapper">
			 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
					
                        <div class="panel-heading">
                           请输入图书详细信息 
                        </div>
						
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="addbook.php" method="POST" target="_top">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">书名</span>
                                            <input type="text" class="form-control" placeholder="图书的题名" name="bookname">
                                        </div>
										<div class="form-group input-group">
                                            <span class="input-group-addon">语言</span>
											<select class="form-control"  name="language">
                                                <option>汉语</option>
                                                <option>英语</option>
                                                <option>法语</option>
                                                <option>俄语</option>
                                                <option>阿拉伯语</option>
												<option>葡萄牙语</option>
												<option>其他</option>
                                            </select> 											
                                        </div>                                            
										<div class="form-group input-group">
                                            <span class="input-group-addon">ISBN</span>
                                            <input type="text" class="form-control" placeholder="每本书的唯一标识ISBN" name="ISBN">
                                        </div>   
										<div class="form-group input-group">
                                            <span class="input-group-addon">主题词</span>
                                            <input type="text" class="form-control" placeholder="请用空格隔开，如：文化 中国" name="subject">	
										</div> 
										<div class="form-group input-group">
                                            <span class="input-group-addon">出版社</span>
                                            <input type="text" class="form-control" placeholder="图书的出版社" name="publisher">
                                        </div>  
										<div class="form-group input-group">
                                            <span class="input-group-addon">出版时间</span>
                                            <input type="text" class="form-control" placeholder="请用-隔开，如：2011-10" name="publishtime">											
                                        </div>  
										<div class="form-group input-group">
                                            <span class="input-group-addon">第一作者</span>
                                            <input type="text" class="form-control" placeholder="本书的第一责任人" name="firstauthor">
                                        </div>     
										<div class="form-group input-group">
                                            <span class="input-group-addon">其他作者</span>
                                            <input type="text" class="form-control" placeholder="其他责任人" name="otherauthor">
                                        </div> 
										<div class="form-group input-group">
                                            <span class="input-group-addon">索书编号</span>
                                            <input type="text" class="form-control" placeholder="在本馆的索书号" name="callnumber">
                                        </div>  	
										<div class="form-group input-group">
                                            <span class="input-group-addon">摘要</span>
                                            <input type="text" class="form-control" placeholder="100字以内的图书摘要" name="abstract">
                                        </div>  
																	
										<div style="float:right">
                                        <button type="submit" class="btn btn-default">确定</button>
                                        <button type="reset" class="btn btn-default">重设</button>
										<button type="button" class="btn btn-default" onclick="window.close();">取消</button>
										</div>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <!--<div class="col-lg-6">
                                    <h1>Disabled Form States</h1>
                                    <form role="form">
                                        <fieldset disabled>
                                            <div class="form-group">
                                                <label for="disabledSelect">Disabled input</label>
                                                <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled>
                                            </div>
											
                                            <div class="form-group">
                                                <label for="disabledSelect">Disabled select menu</label>
                                                <select id="disabledSelect" class="form-control">
                                                    <option>Disabled select</option>
                                                </select>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox">Disabled Checkbox
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Disabled Button</button>
                                        </fieldset>
                                    </form>									
                                    <h1>Form Validation States</h1>
                                    <form role="form">
                                        <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Input with success</label>
                                            <input type="text" class="form-control" id="inputSuccess">
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="inputWarning">Input with warning</label>
                                            <input type="text" class="form-control" id="inputWarning">
                                        </div>
                                        <div class="form-group has-error">
                                            <label class="control-label" for="inputError">Input with error</label>
                                            <input type="text" class="form-control" id="inputError">
                                        </div>
                                    </form>
                                    <h1>Input Groups</h1>
                                    <form role="form">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" placeholder="Username">
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control">
                                            <span class="input-group-addon">.00</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-eur"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Font Awesome Icon">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" class="form-control">
                                            <span class="input-group-addon">.00</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                                                </button>
                                            </span>
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

</body>
</html>
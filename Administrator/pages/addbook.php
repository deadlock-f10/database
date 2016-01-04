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


<?php
$database="library";
$con = mysqli_connect("localhost","root","",$database);
										mysqli_query($con,"set character set 'utf8'");//读库 
										mysqli_query($con,"set names 'utf8'");//写库 
if (!$con){
  	die('Could not connect: ' . mysqli_error());
}
$callnumber=$_POST["callnumber"];
$ISBN=$_POST["ISBN"];
$name=$_POST["bookname"];
$firstauthor=$_POST["firstauthor"];
$otherauthor=$_POST["otherauthor"];
$publisher=$_POST["publisher"];
$publishtime=$_POST["publishtime"];
$subject=$_POST["subject"];

$array = explode(' ', $subject); 
foreach ($array as $key => $value) {  
$result[] = $value; 
} 
$subject1="";$subject2="";$subject3="";$subject4="";$subject5="";
for($i=0;$i<count($result);$i++){
	$x='subject'.($i+1);
	$$x = $result[$i];
}

$language=$_POST["language"];
$abstract=$_POST["abstract"];
$sql="INSERT INTO `book-information`(`callnumber`, `ISBN`, `name`, `firstauthor`, `otherauthor`, `publisher`, `publishtime`, `subject1`, `subject2`, `subject3`, `subject4`, `subject5`, `language`, `abstract`, `reservationnumber`) VALUES ('$callnumber','$ISBN','$name','$firstauthor','$otherauthor','$publisher','$publishtime','$subject1','$subject2','$subject3','$subject4','$subject5','$language','$abstract',0)";
mysqli_query($con,$sql);
insert($callnumber,$abstract);

?>


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
<?php
function insert($callnumber,$essay){
	$words=array();
	$MAX_LENGTH=4;
	while(mb_strlen($essay,'utf-8')>1){
		$len=$MAX_LENGTH;
		if(mb_strlen($essay,'utf-8')<$len) $len=mb_strlen($essay,'utf-8');
		//取指定的最大长度的文本去词典里面匹配
		$matchword=mb_substr($essay,mb_strlen($essay,'utf-8')-$len,mb_strlen($essay,'utf-8')-1,'utf-8');
		while(!contain($matchword)){
			//如果长度为一且在词典中未找到匹配，则按长度为一切分
			if(mb_strlen($matchword,'utf-8')==1) break;
			//如果匹配不到，则长度减一继续匹配
			$matchword=mb_substr($matchword,1,mb_strlen($matchword,'utf-8')-1,'utf-8');
		}
		array_push($words,$matchword);
		//从待分词文本中去除已经分词的文本
		//echo $matchword;
		//echo mb_strlen($matchword,'utf-8');
		$essay=mb_substr($essay,0,mb_strlen($essay,'utf-8')-mb_strlen($matchword,'utf-8'),'utf-8');
		//echo $essay;
		
	}
	//echo $words;
	$con=ConnectDatabase("library");
	for($i=0;$i<count($words);$i++) {    //把切词结果和索书号一起存进索引里
	$sql="INSERT INTO `index`(`callnumber`, `word`) VALUES ('$callnumber','$words[$i]');";
	mysqli_query($con,$sql);
	//if(mysqli_query($con,$sql)){echo "New record inserted successfully ";}
}
CloseDatabase($con);
}
function contain($matchword){
	$con=ConnectDatabase("library");
	$sql="select word from dictionary where word='$matchword';";
	//echo $sql;
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result) < 1) return false;
	else return true;
	CloseDatabase($con);
}
?>
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
            
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
					<br><br><br><br>
					<div style = "text-align:center;">
					<font size="10" face="楷体">恭喜你，上书成功！</font>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					</div>
<div style = "text-align:right;">
<button type="button" class="btn btn-outline btn-success"
onclick="show('onshelve.php')"><i class="fa  fa-plus-circle fa-fw"></i>继续上书</button>	
<button type="button" class="btn btn-outline btn-danger"
onclick="window.close();window.opener.location.reload();"><i class="fa  fa-times fa-fw"></i>退出</button>	
</div>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	<script type="text/javascript">
	function show(url){
		window.open(url,"newwindow", "height=650, width=600, left=400,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=yes");
	}
	</script>

</body>
</html>

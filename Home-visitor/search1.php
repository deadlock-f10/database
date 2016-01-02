<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>三味书屋</title>
	<script language="javascript" type="text/javascript">
function selectInputContent(id){
    obj =document.getElementById(id);
	obj.focus();
	obj.select();
}
function check(value)
{
	if(value=="主题")
	{
	  document.getElementById('keyword').style.display="block";
	  document.getElementById('author').style.display="none";
	  document.getElementById('title').style.display="none";
	  document.getElementById('page').style.display="none";
	}	
	else if(value=="作者")
	{
	  document.getElementById('keyword').style.display="none";
	  document.getElementById('author').style.display="block";
	  document.getElementById('title').style.display="none";
	  document.getElementById('page').style.display="none";
	}
	else if(value=="题目")
	{
	  document.getElementById('keyword').style.display="none";
	  document.getElementById('author').style.display="none";
	  document.getElementById('title').style.display="block";
	  document.getElementById('page').style.display="none";
	}
	else if(value=="全文")
	{
	  document.getElementById('keyword').style.display="none";
	  document.getElementById('author').style.display="none";
	  document.getElementById('title').style.display="none";
	  document.getElementById('page').style.display="block";
	}
}
</script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">
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
function contain($matchword,$con){
	$sql="select * from dictionary where word='$matchword';";
	//echo $sql;
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result) < 1) return false;
	else return true;
}
?>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">三味书屋</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
					<li>
                        <a class="page-scroll" href="../User/pages/login.html">登陆</a>
                    </li>
					<li>
                        <a class="page-scroll" href="../User/pages/register.html">注册</a>
                    </li>
                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
			
                <FORM action="search1.php#searchresult" METHOD="post">
          <input type="button" class="button" value="主题" onclick="javascript:check(this.value);">
		  <input type="button" class="button" value="作者" onclick="javascript:check(this.value);">
		  <input type="button" class="button" value="题目" onclick="javascript:check(this.value);">
		  <input type="button" class="button" value="全文" onclick="javascript:check(this.value);">
		  <input type="button" class="button1" value="">
		  <input type="button" class="button1" value="">
		  <br>
<div id="keyword" style="display: block;text-align:center;margin:auto;">
  <input type="text" name="keyword" class="search_key" value="主题检索" id=textselectk onmouseover="javascript:selectInputContent(this.id)" > 
  <input type="submit" class="submit" value="书海漫游">
</div>
<div id="author" style="display: none;text-align:center;margin:auto;">
<input type="text" name="author" class="search_key" value="作者检索" id=textselecta onmouseover="javascript:selectInputContent(this.id)" > 
<input type="submit" class="submit" value="书海漫游">
</div>
<div id="title" style="display: none;text-align:center;margin:auto;">
 <input type="text" name="title" class="search_key" value="题目检索" id=textselectc onmouseover="javascript:selectInputContent(this.id)" > 
 <input type="submit" class="submit" value="书海漫游">
</div>
<div id="page" style="display: none;text-align:center;margin:auto;">
 <input type="text" name="pages" class="search_key" value="全文检索" id=textselectp onmouseover="javascript:selectInputContent(this.id)"  > 
 <input type="submit" class="submit" value="书海漫游">
</div>

</FORM>
            </div>
        </div>
		
    </header>
					<section id="searchresult">
<h2><font color="black"><center>检索结果</center></font></h2>
	    
	<?php
	$con=ConnectDatabase("library");
	@$keyword=$_POST["keyword"];
	@$author=$_POST["author"];
	@$title=$_POST["title"];
	@$pages=$_POST["pages"];
	$words=array();
   //查询共有多少行数据
   if($keyword!=null and $keyword!="主题检索"){  
	  $sql="SELECT  count(*) FROM `book-information` WHERE subject1 like '%$keyword%' or subject2 like '%$keyword%' or subject3 like '%$keyword%' or subject4 like '%$keyword%' or subject5 like '%$keyword%';";
	  }
  else if($author!=null and $author!="作者检索"){
	  $sql="SELECT  count(*) FROM `book-information` WHERE firstauthor like %$author% or otherauthor like '%$author%';";
	  }
  else if($title!=null and $title!="题目检索"){
	  $sql="SELECT  count(*) FROM `book-information` WHERE name like '%$title%';";
	  }
  else {
	  
	    $MAX_LENGTH=4;
		//echo $pages;
	while(mb_strlen($pages,'utf-8')>1){
		$len=$MAX_LENGTH;
		if(mb_strlen($pages,'utf-8')<$len) $len=mb_strlen($pages,'utf-8');
		//取指定的最大长度的文本去词典里面匹配
		$matchword=mb_substr($pages,mb_strlen($pages,'utf-8')-$len,mb_strlen($pages,'utf-8'),'utf-8');
		//echo $matchword;
		while(!contain($matchword,$con)){
			//如果长度为一且在词典中未找到匹配，则按长度为一切分
			if(mb_strlen($matchword,'utf-8')==1) break;
			//如果匹配不到，则长度减一继续匹配
			$matchword=mb_substr($matchword,1,mb_strlen($matchword,'utf-8')-1,'utf-8');
		}
		array_push($words,$matchword);
		//从待分词文本中去除已经分词的文本
		$pages=mb_substr($pages,0,mb_strlen($pages,'utf-8')-mb_strlen($matchword,'utf-8'),'utf-8');
	}
	$sql="select count(*) from `book-information` where callnumber in (";
	  for($x=0;$x<count($words)-1;$x++) {
		   $sql=$sql."select callnumber from `index` where word='$words[$x]' and callnumber in(";
	  }
	  $sql=$sql."select callnumber from `index` where word='".$words[count($words)-1]."'";
	  for($x=0;$x<count($words);$x++) {
		   $sql=$sql.")";
	  }	
	  
      }
	//echo $sql;
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_row($result);
    $tot = $row[0];
    //每页多少行数据
    $length = 2;      
    //总页数  
    $totpage = ceil($tot / $length);
    //当前页数
    $page = @$_GET['p'] ? $_GET['p'] : 1;
    //limit 下限
    $offset = ($page - 1) * $length;
	echo "<center>";
    echo "<table class=\"bordered\">";
	echo "<thead>";
    echo "<tr>";
    echo "<th>书名</th>";
    echo "<th>作者</th>";
    echo "<th>主题</th>";
	echo "<th>语言</th>";
	echo "<th>摘要</th>";
    echo "</tr>";
	echo "</thead>";
    //将查询出来的数据用表格显示
	if($keyword!=null and $keyword!="主题检索"){
		$sql = "SELECT  `callnumber`, `name`, `firstauthor`,  `subject1`, `subject2`,`subject3`,`language`, `abstract` FROM `book-information` WHERE subject1 like '%$keyword%' or subject2 like '%$keyword%' or subject3 like '%$keyword%' or subject4 like '%$keyword%' or subject5 like '%$keyword%' order by name limit {$offset}, {$length}";
	}
	else if($author!=null and $author!="作者检索"){
	  $sql="SELECT  `callnumber`, `name`, `firstauthor`,  `subject1`,`subject2`,`subject3`, `language`, `abstract` FROM `book-information` WHERE firstauthor like %$author% or otherauthor like '%$author%' order by name limit {$offset}, {$length}";
	  }
  else if($title!=null and $title!="题目检索"){
	  $sql="SELECT  `callnumber`, `name`, `firstauthor`,  `subject1`,`subject2`,`subject3`, `language`, `abstract` FROM `book-information` WHERE name like '%$title%' order by name limit {$offset}, {$length}";
	  }
  else{
	  $sql="select * from `book-information` where callnumber in (";
	  for($x=0;$x<count($words)-1;$x++) {
		   $sql=$sql."select callnumber from `index` where word='$words[$x]' and callnumber in(";
	  }
	  $sql=$sql."select callnumber from `index` where word='".$words[count($words)-1]."'";
	  for($x=0;$x<count($words);$x++) {
		   $sql=$sql.")";
	  }	
	  $sql=$sql." order by name limit {$offset}, {$length}";
	  //echo $sql;
      }
	//echo $sql;
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)) {
		$abstract=mb_substr($row['abstract'],0,50,"utf-8")."……";
        echo "<tr>";
		echo "<form action=\"detail/detail.php\" METHOD=\"post\" target=_blank>";
		echo "<input type=\"text\" name=\"callnumber\" class=\"submit\" style=\"display:none\" value=".$row["callnumber"].">";
        echo "<td class=\".td1\"><input type=\"submit\" class=\"submit1\" value=\"".$row['name']."\"></input></td><td class=\".td2\">{$row['firstauthor']}</td><td class=\".td2\">{$row['subject1']}</td><td class=\".td2\">{$row['language']}</td><td class=\".td3\">{$abstract}</td>";
		echo "</form>";
        echo "</tr>";
    }
    echo "</table>";
    //上一页和下一页
    $prevpage = $page - 1;
    if ($page >= $totpage) {
        $nextpage = $totpage;
    } else {
        $nextpage = $page + 1;
    }
    //跳转
    echo "<h3><center><font color=\"black\">共{$totpage}页</font> &nbsp;&nbsp;&nbsp;<a href='search.php?p={$prevpage}#searchresult' style=\"color:#000000\">上一页</a> | <a href='search.php?p={$nextpage}#searchresult' style=\"color:#000000\">下一页</a></center></h3>";
    echo "</center>";
	echo "</table>";
	echo "</center>";
	
	CloseDatabase($con);
	?>

</section>


   
   

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>

</body>

</html>

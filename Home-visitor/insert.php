<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>三味书屋</title>

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

</body>

</html>

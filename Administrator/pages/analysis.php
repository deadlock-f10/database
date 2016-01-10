<?php // content="text/plain; charset=utf-8"
require_once ('..\..\..\jpgraph-3.5.0b1\src\jpgraph.php');
require_once ('..\..\..\jpgraph-3.5.0b1\src\jpgraph_bar.php');
$con = mysqli_connect("localhost","root","","library");
mysqli_query($con,"set character set 'utf8'");//读库 
mysqli_query($con,"set names 'utf8'");//写库 
date_default_timezone_set("Asia/Shanghai");
$today = date("Y-m-d h:i:sa");  
$aweekago = date("Y-m-d",strtotime("-1 week"));
$querydate = date("Y-m-d",strtotime("-1 week"));
// Some data
$datay=array(0,0,0,0,0,0,0);
for($i = 0 ; $i < 7 ; $i++){
	$querydate = date("Y-m-d",strtotime("$querydate +1 day"));
	$a[$i] = date("m-d",strtotime($querydate));
	$sql="select count(*) from `borrow` where `borrowtime` = '$querydate'";
	$rs=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($rs);
	$datay[$i]=$row[0];
}

// Create the graph and setup the basic parameters 
$graph = new Graph(600,400,'auto');	
$graph->img->SetMargin(40,30,40,40);
$graph->SetScale("textint");
$graph->SetFrame(true,'blue',1); 
$graph->SetColor('lightblue');
$graph->SetMarginColor('lightblue');

// Add some grace to the top so that the scale doesn't
// end exactly at the max value. 
//$graph->yaxis->scale->SetGrace(20);

// Setup X-axis labels
//$a = $gDateLocale->GetShortMonth();
$graph->xaxis->SetTickLabels($a);
$graph->xaxis->SetFont(FF_FONT1);
$graph->xaxis->SetColor('darkblue','black');

// Stup "hidden" y-axis by given it the same color
// as the background
$graph->yaxis->SetColor('lightblue','darkblue');
$graph->ygrid->SetColor('white');

// Setup graph title ands fonts
$graph->title->Set('books borrowed in the past weeks');
$graph->subtitle->Set('(With "hidden" y-axis)');

$graph->title->SetFont(FF_FONT2,FS_BOLD);
$graph->xaxis->title->Set($today);
//$graph->xaxis->title->Set($aweekago);
$graph->xaxis->title->SetFont(FF_FONT2,FS_BOLD);
                              
// Create a bar pot
$bplot = new BarPlot($datay);
$bplot->SetFillColor('darkblue');
$bplot->SetColor('darkblue');
$bplot->SetWidth(0.5);
$bplot->SetShadow('darkgray');

// Setup the values that are displayed on top of each bar
$bplot->value->Show();
// Must use TTF fonts if we want text at an arbitrary angle
$bplot->value->SetFont(FF_ARIAL,FS_NORMAL,8);
$bplot->value->SetFormat('$%d');
// Black color for positive values and darkred for negative values
$bplot->value->SetColor("black","darkred");
$graph->Add($bplot);

// Finally stroke the graph
$graph->Stroke();
?>

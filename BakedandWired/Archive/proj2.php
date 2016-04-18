<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet" type="text/css">  
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet" type="text/css"> 
<link rel="stylesheet" type="text/css" href="Restaurant.css">
<script src="proj.js" type="text/javascript"></script>
</head>
<body id="body" >
<div style="width:1200px; text-align:center; margin-left:auto; margin-right:auto; overflow:auto">
	<h1 id="h1">Baked and Wired Review</h1>
	<img src="BakedandWired.jpg" alt="Baked and Wired" id="BW"/>
	<div id="div1">
		<p>Background Information</p>
	</div>
	<div id="clear"></div>
	<div id="hours">
        <p>Sunday: 8am-8pm</p>
        <p>Monday: 7am-8pm</p>
        <p>Tuesday: 7am-8pm</p>
        <p>Wednesday: 7am-8pm</p>
        <p>Thursday: 7am-8pm</p>
        <p>Friday: 7am-9pm</p>
        <p>Saturday: 8am-9pm</p>
	</div>
	<div name="input" action="" method="get">
 	<td>
    <form method="post">
       <input type="text" name="name" class="first-name" placeholder="Username" size="25">
       </td><textarea rows="10" name="interest" id="comment" placeholder="Comment"></textarea>
       <input type="text" name="rname" value="Baked & Wired" style="visibility:hidden">
       <input type="submit" value="Submit" id="submit">
    </form>
    </div> 
    <div id="add"; style="width:200px;word-wrap:break-word">
</div>
   
</div>
<?php  
$Find=file_get_contents("text.json");

	$data = json_decode($Find, TRUE);
	
$send=array();

$check=0;
for($i=0;$i<sizeof($data["Restaurants"]);$i++){
		$y= (array_keys($data["Restaurants"][$i]));
		if (strtolower($y[0])==strtolower("Baked & Wired")){
			$name=$y[0];
			$found=$i;
			$check=1;
			break;
			
	}}
if ($check==1){
	for($i=0;$i<sizeof($data["Restaurants"][$found][$name]["Comments"]);$i++){
	$y= (array_values($data["Restaurants"][$found][$name]["Comments"][$i]));
	$x=array_keys($data["Restaurants"][$found][$name]["Comments"][$i]);
	array_push($send,$x[0] . "-" . $y[0] . "<br \>");
	}
?>

<script>
	var JSDATA = <?=json_encode($send, JSON_HEX_TAG | JSON_HEX_AMP )?>; 
	main(JSDATA);
</script>
<?
	
}
else{
	$sends="Not found";
	?>
    <script>
	var JSDATA = <?=json_encode($sends, JSON_HEX_TAG | JSON_HEX_AMP )?>; 
	nofound(JSDATA);
	</script>
    <?
	}
?>
<?
	
if (isset($_POST["name"]) && !empty($_POST["name"])){
	
	$Find=file_get_contents("text.json");
	$obj = json_decode($Find,true);
	for($i=0;$i<sizeof($obj["Restaurants"]);$i++){
		$y= (array_keys($obj["Restaurants"][$i]));
		if (strtolower($y[0])==strtolower($_POST["rname"])){
			$rname=$y[0];
			$found=$i;
			$check=1;
			break;
			
	}}
	if ($check==1){
		
		$data['Restaurants'][$found][$rname]["Comments"][] = array($_POST["name"]=>($_POST["interest"]));
	
		
	}
	else{
	echo "check";
$data = json_decode($Find, TRUE);
$userName = $_POST["name"];
$rest=$_POST["rname"];
	$data['Restaurants'][] = array($_POST["rname"]=>array("Comments"=>array(array($userName=>($_POST["interest"])))));
	}
    if ($_POST){//always check, to avoid noticed
        file_put_contents('text.json', json_encode($data,JSON_PRETTY_PRINT));
    }


else echo "";
}


?>
</body>
</html>
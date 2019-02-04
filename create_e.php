<?php


session_start();



//TEST VALUES
/*$_SESSION['loc']='roorkee';
$_SESSION['name']='manas';*/



$ename= $_POST['ename'];
$desc=$_POST['description'];
$dt = $_POST['dt'];
	$name=$_SESSION['name'];
$city=$_SESSION['loc'];


	define('DB_HOST', 'localhost');
define('DB_NAME', 'city');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());


$query = mysql_query("insert into ".$currentchat."_event (name, ename, description, dt) values ('$name', '$ename', '$desc', $dt);");
$row = mysql_fetch_array($query);


echo "<script>window.location='comsign.php';</script>";


?>
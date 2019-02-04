<?php






	$comm= $_POST['community'];
	$name=$_SESSION['name'];
$city=$_SESSION['loc'];
session_start();
	define('DB_HOST', 'localhost');
define('DB_NAME', 'city');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());
$query = mysql_query("select * from communities where name='$comm' and city='$city'");
$row = mysql_fetch_array($query);
if($row){
	echo "ERROR- community already exists!<script>setTimeout(function(){window.location='create_community.php';}, 2000);</script>";
}
else{
$finname=$city."_".$comm;	
$query = mysql_query("insert into communities (name, city) values ('$finname', '$city');");
$query = mysql_query("create table ".$city."_".$comm." (name varchar(50), admin int(1)); ");
$query = mysql_query("create table ".$city."_".$comm."_event (name varchar(50), ename int(1), description varchar(255), dt datetime);" );
$query = mysql_query("insert into ".$city."_".$comm." (name, admin) values ('$name', '1');");
$myfile = fopen("./logs/".$city."_".$comm.".html", "w");
}


echo "<script>window.location='comsign.php';</script>";
?>
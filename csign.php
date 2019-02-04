<?php
session_start(); 
$q=$_REQUEST['w'];
if(!isset($q)){$q=$_GET['w'];}
$name="mohit"; //REMEMBER TO REMOVE FOR FUCK'S SAKE. THIS IS SUPPOSED TO BE REPLACED BY SESSION VARIABLES
$loc="roorkee";
define('DB_HOST', 'localhost');
define('DB_NAME', 'city');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());
 $query    = "INSERT INTO ".$q." (name,admin) VALUES ('".$name."',0)";

    $data = mysql_query($query) or die(mysql_error());
    echo "<script>window.location='chat.php'</script>";
 ?>
<?php 
session_start();
if($_POST['m']=="1")
{
$name=$_POST['name'];
$pass=$_POST['password'];

}
else{
$name=$_REQUEST['u'];
$pass=$_REQUEST['p'];
}
define('DB_HOST', 'localhost');
define('DB_NAME', 'city');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());
$query=mysql_query("SELECT * from user WHERE name='".$name."' AND pass='".$pass."'");
$row=mysql_fetch_array($query);
if ($row){
if($_POST['m']=="1"){
	$query = mysql_query("select name from communities where city = '$city';"  );
	$row = mysql_fetch_array($query);
	$comm=array();
    for($i=0;$row;$i++,$row = mysql_fetch_array($query)){
    	$comm[$i]=$row[0];
    }
    echo json_encode($comm);

}
else{
$_SESSION['name']=$name;
$_SESSION['loc']="roorkee";
$_SESSION['ccity']="roorkee";

echo "<script> window.location='comsign.php' </script>"	;}
}
else{
if($_POST['m']=="1"){
$comm=array();
$comm[0]=="NO";
}
 else{	echo "<script>alert('Invalid username or password'); window.location='index.php' </script> ";
}
}

 ?>
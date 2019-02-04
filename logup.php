<?php


session_start();

if($_POST['m']=="1")
{
$name=$_POST['name'];
$pass=$_POST['password'];
$city=$_POST['city'];
$mob=$_POST['mobile'];
}
else{
	$mob=$_REQUEST['mob'];
$name=$_REQUEST['u'];
$pass=$_REQUEST['p'];
$city=$_REQUEST['c'];
}
define('DB_HOST', 'localhost');
define('DB_NAME', 'city');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());

$query = mysql_query("SELECT MAX(id) FROM user;"  );
    $row = mysql_fetch_array($query);
$query = mysql_query("SELECT * FROM user WHERE name = '$name';") or die(mysql_error());
if (!$row = mysql_fetch_array($query)) {
$_SESSION['name']=$name;
$_SESSION['loc']="roorkee";
$_SESSION['ccity']="roorkee";

$query = mysql_query("SELECT MAX(id) FROM user;"  );
    $row = mysql_fetch_array($query);
} 
else{
	if($_POST['m']=="1"){
		$comm=array();
		$comm[0]="NO";
	}
	else{
	echo "<script>alert('Username already used...'); window.location='index.php' </script> ";
}
}

$id=0;
    if($row){
    $id=(int)$row[0]+1;
    }

$query    = "INSERT INTO  user (id,name,number,res,pass) VALUES ('$id','$name','$mob','$city','$pass')";
$data = mysql_query($query) or die(mysql_error());

if($_POST['m']=="1"){
	$query = mysql_query("select name from communities where city = '$city';"  );
	$row = mysql_fetch_array($query);
	$comm=array();
    for($i=0;$row;$i++,$row = mysql_fetch_array($query)){
    	$comm[$i]=$row[0];
    }
    echo json_encode($comm);

}
else {
	echo "<script> window.location='comsign.php'; </script>";
}
?>
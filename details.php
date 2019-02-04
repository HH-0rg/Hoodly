<?php 
session_start();
$q=$_REQUEST['q'];
$_SESSION['currentchat']=$q;
define('DB_HOST', 'localhost');
define('DB_NAME', 'city');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());
$name=$_SESSION['name']; //REMEMBER TO REMOVE FOR FUCK'S SAKE. THIS IS SUPPOSED TO BE REPLACED BY SESSION VARIABLES
$loc=$_SESSION['loc'];
$query=mysql_query("SELECT * FROM  ".$q." WHERE name='".$name."';" );
$row = mysql_fetch_array($query);
if($row){ echo "<script>window.location='chat.php'</script>"; }
$query = mysql_query("SELECT * FROM communities WHERE name='".$q."';" ) or die("Failed to connect to MySQL: " . mysql_error());
$row = mysql_fetch_array($query);

?>
<html>
<head>
	<script>
		function redirect(){
			var com="<?php echo $q ?>";
			window.location="csign.php?w="+com;
		
		}
	</script>	
</head>
<body>
	<?php 
	echo "<b>Name: </b>".$row[0]."<br><br>";
	$record=1;
	$query = mysql_query("SELECT * FROM ".$q." WHERE name=' ".$q."';" ) or die("Failed to connect to MySQL: " . mysql_error());
	echo "Members :"."<br><ul>";
	while($record){
	$record = mysql_fetch_array($query);
    echo "<li>".$record[0]."</li>";
}
echo "</ul>";

	  ?>
<button onclick="redirect();">Join</button>	  
</body>	
</html>
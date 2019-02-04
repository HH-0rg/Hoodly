<?php 
$_SESSION['currentchat']=$_REQUEST['a'];
$_SESSION['name']=$_REQUEST['b'];
echo "<script>alert('".$_SESSION['name']."');</script>";
echo "<script> window.location='mchat.php';</script>";
 ?>
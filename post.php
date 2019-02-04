<?php
session_start();
$q=$_REQUEST['q'];
$log=$_SESSION['log'];
$s=$_SESSION['name'];
$r="<div class='container'><p>".$q."</p>
  <span class='time-right'>".$s."</span></div>";
$chatlog=fopen($log,a);
fwrite($chatlog,$r);

?>
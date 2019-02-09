<?php

session_start();
define('DB_HOST', 'localhost');
define('DB_NAME', 'city');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());
$name=$_SESSION['name'];
$loc=$_SESSION['loc'];
$_SESSION['log']="logs/roorkee.html";
$log=$_SESSION['log'];

?>



<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles/cards.css" />
  <link rel="stylesheet" href="styles/navbar.css" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>city communitites</title>
  <style type="text/css">

* {box-sizing: border-box;}

  html{
    height: 100vh;
  }
  body{
    height: 100vh;
    padding: 0;
    margin: 0;
  }
  .cont {
    height: 100%;
    display: grid;
  grid-template-columns:  20px auto 20px 500px 20px;
  grid-template-rows: 60px 15px auto 15px 30% 15px;
  justify-items:stretch;
  align-items:stretch;
}
li{
  margin:0;
  padding: -.2em;

}
.top{
  grid-column: 1 / 6;
  grid-row: 1 / 2;
  background-color: #5356ad;
}
.comm{
  grid-column: 2 / 3;
  grid-row: 3 / 6;
  text-align: left;
  overflow-y: auto;

}
.chat{
  grid-column: 4 / 6;
  grid-row: 2 / 7;
  background-color: #5356ad;
}
    h1{
      font-family: Calibri;
      font-size:70px;
      margin: 0;
      padding: 0;
    }
img{
  width:100px;
}


.container {
  padding: 2px 16px;
}

h4{
  margin: 10px;
}
#result{
  visibility: hidden; 
  position: absolute;
  left: 50vw;
  margin-top: -100px;
  margin-left: -35vw;
  width: 70vw;
  transition: all 1s ease-out;
}
.resbox {
  background-color:white;
  padding: 30px;
  font-family: arial;
  font-size: 20px;
  color: white;
  display: none; 
  transition: all 1s ease-out;
}
.resbox span {
  font-size: 25px;
  font-family: Kanit;
  color: lightgray;
}
.crossres{
  z-index: 2450;
  cursor:pointer;
  position: absolute;
  top: 10px;
  color: white;
  display: inline;
  right: 20px;
}
#map{
  width: 60vw;
  height: 80vh;
  position: relative;
  top: 0;
  left:0;
  z-index: 100;
}
#lgbt:hover{
  background-color:#ff1a1a;
  
}
#overlay {
  position: fixed; 
  display: block; 
  width: 100%; 
  height: 100%; 
  top: 0; 
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5); 
  z-index: -1;
   transition: opacity 1s;
  opacity:0;

}

</style>
<script type="text/javascript" src="scripts/cards.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <link rel="stylesheet" type="text/css" href="styles/chat.css">
  <script>
    document.getElementById("send").addEventListener("mousedown",function(){document.getElementById("send").class="fa fa-paper-plane-o"})
    </script>
</head>
<body>
 <div id="overlay"></div>
<?php if(!isset($name)){echo "<script>window.location='index.php'</script>";} ?>

  <img src="images/circle.gif" style="position:absolute; height:400px; width:400px; z-index:2; bottom:0px; left:0px; margin-left:-150px; margin-bottom:-150px; opacity:0.7;">
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="z-index:3; display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()" style="text-align:center; padding:0px; "><h5>Collapse &times</h5></button>
  <img src="user.jpg"  style="height:200px; width:200px; border-radius:50%;"><br><br><br>
  
  <a style="text-align:center;margin-top:60px;" class="w3-bar-item w3-button"><h3>My communities</h3></button>
  <a href="create_community.php" style="text-align:center;" class="w3-bar-item w3-button"><h3>Create A community</h3></a>
  <a href="index.php?logout=true" style="text-align:center;" class="w3-bar-item w3-button" id="lgbt"><h3>Log out</h3></a>
</div>

<div id="result">

<div class="resbox" id="r3">
  <span class="crossres" onclick="band_karo(3)">✖</span>
 <div class='map' id='map'></div>
</div>
</div>

<div class='cont' id="main">

<div class='top'><button style="float:left; margin-top:4px; height:52px;" id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button><button style="float:left; margin-top:4px; height:52px;" id="openNav" class="w3-button w3-teal w3-xlarge" onclick="kholo(3)">MAP</button><span style="font-family: helvetica; font-size:35px;  position:absolute; right:0px; opacity:0.6;"><?php echo $loc ?> city</span>  </div>


<div class='comm'>
<ul class="card-list" style="padding:0px; ">
<?php
$query = mysql_query("SELECT name FROM communities WHERE city='".$loc."';" ) or die("Failed to connect to MySQL: " . mysql_error());

$ret="";
$lol="";
$row=1;
$row = mysql_fetch_array($query);
while($row){


echo "<li class='card' style='margin:0px;'>
    <a class='card-image' href='details.php?q=".$row[0]."'  style='background-image: url(images/HH.jpg)' data-image-full='images/HH.jpg'>
      <img src='images/HH.jpg' alt='Psychopomp' />
    </a>
    <a class='card-description' href='details.php?q=".$row[0]."'>
      <h2 style='text-align:center;'>".$row[0]."</h2>
      <p style='text-align:center;'>".$row[0]."</p>
    </a>
  </li>";
$row = mysql_fetch_array($query);
}

?>
</ul>
<br><br>
</div>

<!--<div class="event">
  <?php
?>
</div>-->

<div class='chat'>
    <div id="menu">
        <h2 class="welcome"><b>Welcome, <?php


         echo $_SESSION['name']; ?></b></h2>
        
        <div style="clear:both"></div>
    </div>
     
    <div id="chatbox" style="width:98%; align:center; height:75%; border-top:6px solid #ACD8F0;">
        <?php
if(file_exists("<?php echo $log; ?>") && filesize("<?php echo $log; ?>") > 0){
    $handle = fopen("/logs/roorkee.html", "r");
    $contents = fread($handle, filesize($log));
    fclose($handle);
     
    echo $contents;
}
?>
    </div>
     
        <input name="usermsg" type="text" id="usermsg" size="" style="width:400px; margin-left:20px; height:15px;"/> 

          <button name="submit" class="butt" onclick="sender()"  id="submitmsg"><i id="send" class="fa fa-paper-plane" aria-hidden="true"></i></button>

</div>


</div>
 <script type="text/javascript">
    setInterval (loadLog, 100);

function loadLog(){     
        var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; 
        $.ajax({
            url: "<?php echo $log; ?>",
            cache: false,
            success: function(html){
            var cont=document.getElementById('chatbox').innerHTML;
            if(cont!=html){        
                $("#chatbox").html(html);   
                }
                //Auto-scroll           
                var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
                if(newscrollHeight > oldscrollHeight){
                    $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); 
                }               
            },
        });
    }
$(document).ready(function(){

    $("#exit").click(function(){
        var exit = confirm("Are you sure you want to end the session?");

        if(exit==true){window.location = 'index.php?logout=true';}      
    });
});


function sender(){
    var msg=document.getElementById('usermsg').value;
    if(msg.length<=30){
    var xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById('usermsg').value="";
         }
    };
    xmlhttp.open("GET", "post.php?q="+msg, true);
    xmlhttp.send();}
    else{
      document.getElementById('usermsg').value="";
      alert("The string entered must be non empty and less than 30 characters");
    }
}
</script>
       
<script type="text/javascript">
function w3_open() {

  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
  document.getElementById('overlay').style.opacity = 0.6;
  document.getElementById('overlay').style.zIndex=2;
}
function w3_close() {
 
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
  document.getElementById('overlay').style.zIndex= -2;
    document.getElementById('overlay').style.opacity = 0;

}
    document.getElementById('overlay').addEventListener('click',function(){w3_close();})

for (const btn of document.querySelectorAll('.vote')) {
  btn.addEventListener('click', event => {
    event.target.classList.toggle('on');
  });
}
function kholo(t) {
  document.getElementById("result").style.visibility = "visible";
  document.getElementById("r"+t).style.display = "block";
  document.getElementById("result").style.marginTop = "10px";
  document.getElementById("main").style.opacity = "0.5";
  document.body.scrollTop=0;
  
}

function band_karo(a) {
  document.getElementById("result").style.marginTop = "-100px";
  document.getElementById("main").style.opacity = "1";
  document.getElementById("result").style.visibility = "hidden";
  document.getElementById("r"+a).style.display = "none";
  document.body.scrollTop= 0;
}
     function myMap() {
   var mapCanvas = document.getElementById("map");
     var myCenter = new google.maps.LatLng(29.855535,77.8798866); 
     var mapOptions = {
      center: myCenter, zoom: 13,panControl: true,
    zoomControl: true,
    mapTypeControl: true,
    scaleControl: true,
    streetViewControl: true,
    overviewMapControl: true,
    rotateControl: true};
     var map = new google.maps.Map(mapCanvas,mapOptions);
     var request = {
          query: 'Roorkee, India',
          fields: ['name', 'geometry'],
        };
     service.findPlaceFromQuery(request, function(results, status) {
          if (status === google.maps.places.PlacesServiceStatus.OK) {

            map.setCenter(results[0].geometry.location);
          }
        });
     var marker = new google.maps.Marker({
     position: myCenter,
  });

infowindow.open(map,marker);}


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBa_4gRwATtex5KPwLVUBOwSqp88A2UlLY&libraries=places&callback=myMap" async defer></script>
</body>
</html>
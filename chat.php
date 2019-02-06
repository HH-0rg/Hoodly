<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 

session_start();
       
$q=$_SESSION['currentchat'];
$a="roorkee";
$b=$q;
define('DB_HOST', 'localhost');
define('DB_NAME', 'city');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());
$dt = date('Y-m-d H:i:s');
$name=$_SESSION['name']; 
$loc=$_SESSION['loc'];
$e=$q."_event";

$query = mysql_query("DELETE FROM ".$e." WHERE dt < '$dt'") or die(mysql_error());

$query=mysql_query("SELECT * FROM  ".$e );
$row = mysql_fetch_array($query);
$log= "logs/".$q.".html";
$_SESSION['log']=$log;
$ename= $row[1];
$des= $row[2];
$date= $row[3];

$query=mysql_query("SELECT * FROM ".$q." WHERE name='".$name."'") or die(mysql_error());
  $row = mysql_fetch_array($query);
  $admin=$row[1];
 
 ?>
<html>
<head>

	    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
	<link rel="stylesheet" type="text/css" href="styles/chat.css">
	<script>
    document.getElementById("send").addEventListener("mousedown",function(){document.getElementById("send").class="fa fa-paper-plane-o"})
    </script>
</head>
<body>
     <script>alert('the value of the admin attribute is <?php echo $admin ?>')</script>
	<div id="wrapper" style="width:50%; background-color:#5356ad; align-self: center; top:0px; align-content:center;margin-top:30px; margin-right:25%; height:85%; border-style:none;">
    <div id="menu">
        <h2 class="welcome"><b>Welcome, <?php


         echo $_SESSION['name']; ?></b></h2>
         <?php if($admin==1){
          echo '<p class="logout"><a id="exit" href="create_event.php"><button class="butt"><strong>Create Event</strong></button></a></p>';
     }
         ?>
        <p class="logout" style="margin-right:15px; "><a id="exit" href="comsign.php"><button class="butt"><strong>Exit Chat</strong></button></a></p>
        <div style="clear:both"></div>
    </div>
     
    <div id="chatbox" style="width:98%; align:center; height:73%; border-top:6px solid #ACD8F0;">
        <?php
if(file_exists("<?php echo $log; ?>") && filesize("<?php echo $log; ?>") > 0){
    $handle = fopen($log, "r");
    $contents = fread($handle, filesize($log));
    fclose($handle);
     
    echo $contents;
}
?>
    </div>
     <div style="text-align: center;">
        <input name="usermsg" type="text" id="usermsg" size="" style="height:15px;"/> 

          <button name="submit" class="butt" onclick="sender()" style=""  id="submitmsg"><i id="send" class="fa fa-paper-plane" aria-hidden="true"></i></button></div>

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

</body>	
</html>  
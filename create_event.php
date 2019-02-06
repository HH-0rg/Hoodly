<!DOCTYPE html>
<html>
<head>
	<title>Create Event</title>
	<style type="text/css">
	body{
		margin: 0;
		padding: 0;
		background-image: url('images/bg.jpg');
		background-size: cover;
	}
		.nav{
			height:100px;
			background-color: black;
		}
		form{
			font-family: Arial;
			position: absolute;
			top:30%;
			left: 50%; 
			width:400px;
			margin-left: -200px;
		}
		input{
			margin-bottom: 30px;
			width: 400px;
			border-radius: 3px;
			padding: 10px;
			border: solid 1px ;
		}
#butt{
			transition: all 1s ease;
		}
		#butt:hover{
			color: white;
			background-color: black;
		}
	</style>
</head>
<body>
<div class='nav'></div>
<form action="create_e.php" method="POST">
	<h1>Create Event</h1>
	<input type="text" name="ename" placeholder="Event Name"><br>
	<input type="text" name="description" placeholder="Description"><br>
	<input type="text" name="dt" placeholder="Date-Time of the event"><br>
	<input id="butt" type="submit" name="">
</form>
</body>
</html>
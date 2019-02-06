<!DOCTYPE html>
<html>
<head>
	<title>Create Community</title>
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
			color:white;
			background-color: #ff6600;
			transition: all 0.3s ease;
		}
		#butt:hover{
			color: #ff6600;
			background-color: white;
		}
	</style>
</head>
<body>
<div class='nav'></div>
<form action="create_c.php" method="POST">
	<h1>Create Community</h1>
	<input type="text" name="community" placeholder="Community Name/Topic">
	<input id="butt" type="submit" name="">
</form>
</body>
</html>
<?php
session_start();
include("db.php");
$err="";
if(isset($_POST["btnlogin"])=="login")
{
	$id=$_POST["txtid"];
	$pass=$_POST["txtpass"];	

	$qry="select * from employeetb where empemail='$id' and emppass='$pass'";
	$res=mysqli_query($con,$qry);
	$row =  mysqli_fetch_array($res);
	if($row[7]==1)
	{
		header("Location:show.php");
	}
	else if($row[0]){
		$_SESSION["userid"]=$row[0];
		header("Location:show1.php");
	}
	else{
		$err="user not found";
		session_destroy();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<style type="text/css">
		body{
			background: #696969	;
		}
		div{
			align-self: center;
			align-items: center;
			text-align: center;
			margin-left:400px;
			margin-right:400px;
			margin-top:200px;
			margin-bottom:200px;
  			box-shadow: 10px 10px 10px 10px #01110091;
		}
		input{
			border-radius: 10px; 
			padding: 5px;
			text-align: center;
		}
		input:focus{
			outline: none;
		}
	</style>
</head>
<body>
	<div>
		<form method="post">
		<label>LOGIN</label><br/><br>
		<label>Email ID:</label>
		<input type="text" name="txtid"><br><br/>
		<label>Password:</label>
		<input type="Password" name="txtpass"><br><br>
		<input type="submit" name="btnlogin" value="LOGIN"><br/><br>
		<h2><?php echo $err;?></h2>
	</form>
	</div>
</body>
</html>
<?php
session_start();
$id=$_SESSION["userid"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>show details</title>
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
	</style>
</head>
<body>
	<form method="post">
			<?php
			include("db.php");
			$qry="select * from employeetb where empid=$id";
			$res=mysqli_query($con,$qry);
			while($row=mysqli_fetch_array($res))
			{
			?>
				<div>
				name :  
				<?php echo $row[1]?><br>
				email id :  
				<?php echo $row[4]?><br>
				password :  
				<?php echo $row[2]?><br>
				date of birth :  
				<?php echo $row[3]?><br>
				depart id :  
				<?php echo $row[5]?><br>
				phone number :  
				<?php echo $row[6]?><br>
				is admin :  
				<?php echo $row[7]?><br>
				gender :  
				<?php echo $row[8]?><br>
				pic :  
				<img src="<?php echo $row[9]?>" height=100 width=100><br>
				update :  
				<a href="update.php?userid=<?=$row[0];?>">update</a><br>
				delete :  
				<a href="delete.php?userid=<?=$row[0];?>">delete</a><br>
			</div>
			<?php
			}
			?>		
		<a href="logout.php">logout</a>
	</form>
</body>
</html>
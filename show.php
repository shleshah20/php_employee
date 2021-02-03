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
			margin: 10px;
			/*margin-left:400px;
			margin-right:400px;
			margin-top:200px;
			margin-bottom:200px;*/
  			box-shadow: 10px 10px 10px 10px #01110091;
		}
		label{
			text-transform: capitalize;
		}
		form {
			width: 100%;
			display: grid;
			grid-template-columns: repeat(3,1fr);
		}
		a{
			color:black; 
		}
	</style>
</head>
<body>
	<a href="insert.php">Add Employee</a> 			
	<a href="logout.php">logout</a>
	<form method="post">

		<?php
			include("db.php");
			$qry="select * from employeetb";
			$res=mysqli_query($con,$qry);
			while($row=mysqli_fetch_array($res))
			{
			?>
				<div>
				
				<label>name : </label>
				<?php echo $row[1]?><br>
				<label>email id : </label>
				<?php echo $row[4]?><br>
				<label>password : </label>
				<?php echo $row[2]?><br>
				<label>date of birth : </label> 
				<?php echo $row[3]?><br>
				<label>depart id : </label>
				<?php echo $row[5]?><br>
				<label>phone number : </label>
				<?php echo $row[6]?><br>
				<label>is admin : </label>
				<?php echo $row[7]?><br>
				<label>gender : </label>
				<?php echo $row[8]?><br>
				<label>pic : </label>
				<img src="<?php echo $row[9]?>" height=100 width=100><br>
				<label>update : </label>
				<a href="update1.php?userid=<?=$row[0];?>">update</a><br>
				<label>delete : </label>
				<a href="delete1.php?userid=<?=$row[0];?>">delete</a><br>
				</div>
			<?php
			}
			?>
	</form>
</body>
</html>
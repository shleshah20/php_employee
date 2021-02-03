<?php
	session_start();
?>
<html>
<head>
	<title>update employee</title>
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
	<?php
	include("db.php");
	$errname=$erremail=$errpass=$errcpass=$errdob=$errph=$errdpt=$errid="";
	$id=$_SESSION["userid"];
	if(isset($_POST["btnupdate"])=="update")
	{
		$name=$_POST["txtname"];
		$email=$_POST["txtemail"];
		$pass=$_POST["txtpass"];
		$cpass=$_POST["txtcpass"];
		$dob=$_POST["txtdob"];
		$ph=$_POST["txtph"];
		$dpt=$_POST["deptcombo"];
		$gender=$_POST["txtgender"];
		if(!move_uploaded_file($filetmp_path, $dest_path))
		{
			$fnameerr = "file upload fail";
			$c++;
		}
		if(isset($_POST['txtadmin']))
			$admin=$_POST["txtadmin"];
		if(!preg_match("/[a-zA-Z]/", $name)){
			$errname="alpha only";
			$c++;
		}
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$erremail="this is required";
			$c++;
		}
		if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z])(?=.*[!@#$%&*]).{8,}$/", $pass))
		{
			$errpass="it's not strong";
			$c++;
		}
		else if(strcasecmp($pass,$cpass) <> 0){
			$errcpass="password does not match";
			$c++;
		}
		if($c==0)
		{
			$qry="update employeetb set empname='$name' ,emppass='$pass', empdob='$dob', empemail='$email',deptid='$dpt',phno=$ph,empgender='$gender' where empid=$id";
			$res=mysqli_query($con,$qry);

			if($res)
			{
				echo "done";
				header("location:show.php");
			}
			else{
				echo mysqli_error($con);
			}
		}
	}
	?>
	<?php
	$qry= "select * from employeetb where empid=$id";
	$row=mysqli_query($con,$qry);
	while($res=mysqli_fetch_array($row))
	{
	?>
	<form method="post">
		<label>Name:</label>
		<input type="text" name="txtname" value="<?php echo $res[1] ?>"><br/>
		<label>EmailId:</label>
		<input type="text" name="txtemail" value="<?php echo $res[4] ?>"><br/>
		<label>password:</label>
		<input type="password" name="txtpass" value="<?php echo $res[2] ?>"><br/>
		<label>conform password:</label>
		<input type="password" name="txtcpass" value="<?php echo $res[2] ?>"><br/>
		<label>date of birth:</label>
		<input type="date" name="txtdob" value="<?php echo $res[3]; ?>"><br/>
		<label>phone number:</label>
		<input type="number" name="txtph" value="<?php echo $res[6] ?>"><br/>
		<label>department name:</label>
		<select name="deptcombo">
			<?php
			$qry="select * from depttb";
			$res1=mysqli_query($con,$qry) ;
			while($drow=mysqli_fetch_array($res1))
			{
			?>
				<option value="<?php echo $drow[0] ?>"<?php if($drow[0]==$res[5]) echo "selected"; ?>><?php echo $drow[1]; ?></option>	
			<?php
			}
			?>
		</select><br/>
		<input type="submit" name="btnupdate" value="update">
	</form>
	<?php
	}
	?>
</body>
</html>
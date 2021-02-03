<html>
<head>
	<title>insert employee</title>
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
		label{
			text-transform: capitalize;
		}
	</style>
</head>
<body>
	<?php
	include("db.php");
	$errname=$erremail=$errpass=$errcpass=$errdob=$errph=$errdpt="";
	$c=0;
	$admin="false";
	if(isset($_POST["btnsub"])=="submit")
	{
		$name=$_POST["txtname"];
		$email=$_POST["txtemail"];
		$pass=$_POST["txtpass"];
		$cpass=$_POST["txtcpass"];
		$dob=$_POST["txtdob"];
		$ph=$_POST["txtph"];
		$dpt=$_POST["deptcombo"];
		$gender=$_POST["txtgender"];
		$filetmp_path=$_FILES['txtpic']['tmp_name'];
		$dest_path="upload/".$_FILES['txtpic']['name'];
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
			$qry="insert into employeetb(empid,empname,emppass,empdob,empemail,deptid,phno,isadmin,empgender,empic) values(NULL,'$name','$pass','$dob','$email','$dpt',$ph,$admin,'$gender','$dest_path')";
			$res=mysqli_query($con,$qry);
			if($res)
			{
				header("location:show.php");
			}
			else{
				echo mysqli_error($con);
			}
		}
	}
	?>
	<form method="post" enctype="multipart/form-data">
		<div>
		<label>add employee</label><br/>
		<label>Name:</label>
		<input type="text" name="txtname" required>
		<?php echo $errname;?><br>
		<label>EmailId:</label>
		<input type="text" name="txtemail" required>
		<?php echo $erremail;?><br>
		<label>password:</label>
		<input type="password" name="txtpass" required>
		<?php echo $errpass;?><br>
		<label>conform password:</label>
		<input type="password" name="txtcpass" required>
		<?php echo $errcpass;?><br>
		<label>date of birth:</label>
		<input type="date" name="txtdob" required>
		<?php echo $errdob;?><br>
		<label>phone number:</label>
		<input type="tel" name="txtph" pattern="^[6-9]{1}[0-9]{9}$" required>
		<?php echo $errph;?><br>
		<label>department name:</label>
		<select name="deptcombo">
			<?php
			$qry="select * from depttb";
			$res=mysqli_query($con,$qry) ;
			while($row=mysqli_fetch_array($res))
			{
			?>
				<option value="<?php echo $row[0] ?>"><?php echo $row[1]; ?></option>	
			<?php
			}
			?>
		</select><br/>
		<input type="checkbox" name="txtadmin" value="true">are you admin?<br>
		gender:
		<input type="radio" name="txtgender" value="male" checked="true">male
		<input type="radio" name="txtgender" value="female">female<br>
		<input type="file" name="txtpic"><br>
		<input type="submit" name="btnsub" value="submit">
	</form>
</div>
</body>
</html>
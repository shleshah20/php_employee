<?php
session_start();
include("db.php");
$id=$_GET["userid"];
$qry="delete from employeetb where empid=$id";
$res=mysqli_query($con,$qry);
if($res)
{
	header("Location:show.php");
}
mysqli_close($con);
?>
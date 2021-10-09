<?php
include('../config/constant.php');
echo $id=$_GET['id'];
$sql="delete from admin where id=$id";
$res=mysqli_query($conn,$sql);
if($res==true){
	//echo "admin deleted";
	$_SESSION['delete']=" <div class='success'> Admin Deleted success.</div>";
	 header('location:'.SITEURL.'admin/manage.admin.php');
}
else
{
	$_SESSION['delete']=" <div class='error'> failed to Deleted.</div>";
	header('location:'.SITEURL.'admin/manage.admin.php');
}
?>
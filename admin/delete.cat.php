<?php
include('../config/constant.php');
if(isset($_GET['id']) AND ($_GET['image_name'])){
$id=$_GET['id'];
$image_name=$_GET['image_name'];
if($image_name!=""){
	$path="../images".$image_name;
	$remove=unlink($path);
	if($remove==false){
		$_SESSION['remove']="<div class='error'>Failed to remove category image</div>";
		header('location'.SITEURL.'admin/manage.category.php');
		die();
	}
}
$sql="DELETE FROM cat WHERE id=$id";
$res=mysqli_query($conn,$sql);
if($res==true){
$_SESSION['delete']="<div class='success'>Category deleted successfully</div>";
header('location:'.SITEURL.'admin/manage.category.php');
}
else{
   $_SESSION['delete']="<div class='error'>failed to delete</div>";
   header('location'.SITEURL.'admin/manage.category.php');
}

}
else{
	$_SESSION['delete']=" <div class='success'> Admin Deleted success.</div>";
	header('location'.SITEURL.'admin/manage.category.php');
}
?>